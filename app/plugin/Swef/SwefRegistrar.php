<?php

namespace Swef;

class SwefRegistrar extends \Swef\Bespoke\Plugin {


/*
    PROPERTIES
*/

    public  $context;
    public  $method;


/*
    EVENT HANDLER SECTION
*/

    public function __construct ($page) {
        // Always construct the base class - PHP does not do this implicitly
        parent::__construct ($page,'\Swef\SwefRegistrar');
    }

    public function __destruct ( ) {
        // Always destruct the base class - PHP does not do this implicitly
        parent::__destruct ( );
    }

    public function _on_pageIdentifyBefore ( ) {
        if ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_reg) {
            $this->method = swefregistrar_mtd_reg;
        }
        elseif ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_regd) {
            $this->method = swefregistrar_mtd_regd;
        }
        elseif ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_eml_vfy) {
            $this->method = swefregistrar_mtd_eml_vfy;
        }
        elseif ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_eml_vfyd) {
            $this->method = swefregistrar_mtd_eml_vfyd;
        }
        elseif ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_pwd_chg) {
            $this->method = swefregistrar_mtd_pwd_chg;
        }
        elseif ($_SERVER[SWEF_STR_REQUEST_URI]==swefregistrar_sct_pwd_chgd) {
            $this->method = swefregistrar_mtd_pwd_chgd;
        }
        else {
            return SWEF_BOOL_TRUE;
        }
        if (!method_exists($this,$this->method)) {
            $this->method = null;
            return SWEF_BOOL_TRUE;
        }
        $this->context = $this->page->swef->db->dbCall (
            swefregistrar_call_context
           ,$this->page->swef->context[SWEF_COL_CONTEXT]
        );
        if (!is_array($this->context)) {
            $this->method = null;
            return SWEF_BOOL_TRUE;
        }
        return SWEF_BOOL_FALSE;
    }

    public function _on_pageScriptBefore ( ) {
        if (!$this->method) {
            return SWEF_BOOL_TRUE;
        }
        $method = $this->method;
        $this->$method ();
        return SWEF_BOOL_FALSE;
    }



/*
    REGISTRAR PROCESS METHODS
*/


    public function emailVerify ( ) {
    }

    public function memberRegister ( ) {
    }

    public function passwordChange ( ) {
    }

    public function reportResult ( ) {
    }



/*
    DASHBOARD SECTION
*/


    public function _dashboard ( ) {
        require_once swefregistrar_file_dash;
    }

    public function _info ( ) {
        $info   = __FILE__.SWEF_STR__CRLF;
        $info  .= SWEF_COL_CONTEXT.SWEF_STR__EQUALS;
        $info  .= $this->page->swef->context[SWEF_COL_CONTEXT];
        return $info;
    }

}

?>

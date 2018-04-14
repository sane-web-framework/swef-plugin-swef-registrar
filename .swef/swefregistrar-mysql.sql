
-- SWEF PLUGIN REGISTRATION --

INSERT IGNORE INTO `swef_config_plugin`
    (
      `plugin_Dash_Allow`, `plugin_Dash_Usergroup_Preg_Match`, `plugin_Enabled`,
	  `plugin_Context_LIKE`, `plugin_Classname`, `plugin_Handle_Priority`
	)
  VALUES
    ( 1, '<^sysadmin$>', 0, 'dashboard', '\\Swef\\SwefRegistrar', 3 ),
    ( 0, '', 0, 'www-%', '\\Swef\\SwefRegistrar', 3 );


-- SWEF SHORTCUTS --

INSERT INTO `swef_shortcut` (`shortcut_Is_System`, `shortcut_Context_LIKE`, `shortcut_Shortcut_URI`, `shortcut_Endpoint_URI`) VALUES
(1, 'www-%',  '/password',  'www.anon.registrar'),
(1, 'www-%',  '/register',  '/www.anon.registrar'),
(0, 'www-%',  '/verify',  '/www.anon.registrar');

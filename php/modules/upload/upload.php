<?php

# check session/login
//_::session();


require_once(
									_::run(
													array(
																	'line'=>'post',
																	'json'=>'json',
																	's1'=>'server',
																	's2'=>'server',
																	's3'=>'server',
																	'doodroid'=>'doodroid',
																	'teededball'=>'teededball',
																	'boxzaracing'=>'boxzaracing',
																	'nestofgong'=>'nestofgong',
													),
													true,
													function()
													{
														exit;
													}
									)
);

?>
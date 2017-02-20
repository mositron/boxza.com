<?php

# run - web application   ( 'link' => 'folder' )
require_once(
	_::run(
		array(
			'' => 'home',
			'home' => 'home',
		)
	)
);

_::template()->display('content');
?>
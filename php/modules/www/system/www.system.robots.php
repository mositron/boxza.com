<?php if(_::$type=='api'):?>
User-agent: *
Disallow: /
<?php else:?>
User-agent: *
Disallow: /_static/
<?php endif?>
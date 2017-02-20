<?php
_::session();

_::$meta['title'] = 'ลิ้งค์ไปยังเว็บภายนอก';
_::$meta['description'] = _::$meta['title'].' - สังคมออนไลน์ของคนไทย';
_::$meta['keywords'] = 'ภายนอก';


_::$content = _::template()->fetch('home');


?>
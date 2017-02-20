<?php
return array(
							'_service'=>array(
													'_id' => -2,
													'name' => 'บริการทั้งหมด',
													'module' => 'service',
													'category' => 'system',
							),
							'_user'=>array(
													'_id' => -3,
													'name' => 'สมาชิก',
													'module' => 'user',
													'category' => 'system',
							),
							'_pref'=>array(
													'_id' => -4,
													'name' => 'ปรับแต่งค่าพื้นฐาน',
													'module' => 'pref',
													'category' => 'system',
							),
							'_layout'=>array(
													'_id' => -5,
													'name' => 'จัดข้อมูลการแสดงผล',
													'module' => 'layout',
													'category' => 'system',
							),
							'_file'=>array(
													'_id' => -6,
													'name' => 'จัดการไฟล์',
													'module' => 'file',
													'category' => 'system',
							),
							'_menu'=>array(
													'_id' => -7,
													'name' => 'จัดการเมนู',
													'module' => 'menu',
													'category' => 'system',
							),
							/*
							'_template'=>array(
													'_id' => -6,
													'name' => 'จัดการเทมเพลต',
													'module' => 'template',
													'category' => 'system',
							),
							*/
							'home'=>array(
												//	'_id' => -1,
													'name' => 'หน้าแรก',
													'category' => 'system',
													'module' => 'home',
													'index'=>true,
							),
							'news'=>array(
													'name' => 'ข่าวสาร',
													'multi' => true,
													'option' => array('limit'=>20,'url'=>'%id%','lang'=>0),
													'category' => 'general',
													'index'=>true,
							),
							'gallery'=>array(
													'name' => 'อัลบั้มรูปภาพ',
													'multi' => true,
													'option' => array('limit'=>20,'url'=>'%id%','lang'=>0),
													'category' => 'general',
													'index'=>true,
							),
							'calendar'=>array(
													'name' => 'ปฎิทินกิจกรรม',
													'option' => array('limit'=>20,'url'=>'%id%','lang'=>0),
													'category' => 'general',
													'index'=>true,
							),
							'product'=>array(
													'name' => 'สินค้า',
													'multi' => true,
													'option' => array('limit'=>20,'url'=>'%id%','lang'=>0),
													'category' => 'shop',
													'link' => 'product',
													'index'=>true,
							),
							'how-to-order'=>array(
													'name' => 'วิธีการชำระเงิน',
													'option' => array('lang'=>0),
													'category' => 'shop',
													'link' => 'how-to-order',
							),
							'payment'=>array(
													'name' => 'แจ้งการชำระเงิน',
													'option' => array('lang'=>0),
													'category' => 'shop',
													'link' => 'payment',
							),
							'promotion'=>array(
													'name' => 'โปรโมชั่น',
													'category' => 'shop',
													'link' => 'promotion',
							),
							'blog'=>array(
													'name' => 'บล็อก',
													'option' => array('limit'=>20,'url'=>'%id%'),
													'category' => 'general',
													'index'=>true,
							),
							/*'forum'=>array(
													'name' => 'ฟอรั่ม',
													'option' => array('limit'=>20,'url'=>'%id%'),
													'category' => 'general',
													'index'=>true,
							),*/
							'contact'=>array(
													'name' => 'ติดต่อเรา',
													'link' => 'contact-us',
													'category' => 'general',
													'index'=>true,
							),
							'banner'=>array(
													'name' => 'แบนเนอร์',
													'multi' => true,
													'option' => array('limit'=>20,'url'=>'%id%'),
													'category' => 'general',
							),
)





?>
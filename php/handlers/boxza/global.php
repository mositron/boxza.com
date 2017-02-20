<?php
#
/*
ip วงใน
144 - web (นอก 139)
145 - web (นอก 140)
140 - db ตัวเก่า (social)
141 - web ตัวเก่า (social)
143 - memcache
146 - db ตัวใหม่


*/

return [
							'protocol' => 'http',
							'domain' => 'boxza.com',
							'path' => '/',
							'block'=>'xxxxxxxxxxxxxxxxxxx',
							'bux_logs'=>false,
							'chat_key'=>'xxxxxxxxxxxxxxxxxxx',
							'line_expire'=>2592000,
							'db' => [
													'default' => [
																					'find_logs'=>false,
																					'host'=>[
																											'db1'=>[
																																	'host' => '192.168.1.128', // เครื่อง 1
																																	'user' => 'xxxxxxxxxxxxxxxxxxx',
																																	'pass' => 'xxxxxxxxxxxxxxxxxxx',
																																	'db' => 'inetdb',
																																	'seq'=>'db1_seq',
																											],
																											'db_chat'=>[
																																	'host' => '192.168.1.133', // เครื่อง 2
																																	'user' => 'xxxxxxxxxxxxxxxxxxx',
																																	'pass' => 'xxxxxxxxxxxxxxxxxxx',
																																	'db' => 'inetdb',
																																	'seq'=>'db_chat_seq',
																											],
																											'db3'=>[
																																	'host' => '192.168.1.151:27019', // เครื่อง 3
																																	'user' => 'xxxxxxxxxxxxxxxxxxx',
																																	'pass' => 'xxxxxxxxxxxxxxxxxxx',
																																	'db' => 'inetdb',
																																	'seq'=>'db3_seq',
																																				],
																											'db6'=>[
																																	'host' => '192.168.1.155', // เครื่อง 3
																																	'user' => 'xxxxxxxxxxxxxxxxxxx',
																																	'pass' => 'xxxxxxxxxxxxxxxxxxx',
																																	'db' => 'inetdb',
																																	'seq'=>'db6_seq',
																																				],
																											],
																					'collection' => [
																															'find_logs'=>'db_chat',
																															'about'=>'db1',
																															'album_vote'=>'db1',
																															'deal'=>'db1',
																															'deal_cate'=>'db1',
																															'deal_province'=>'db1',
																															'cron_notifications'=>'db1',
																															'cron_fb'=>'db1',
																															'chatroom'=>'db1',
																															'email'=>'db1',
																															'emails'=>'db1',
																															'feedback'=>'db1',
																															'game'=>'db1',
																															'glitter'=>'db1',
																															'gift'=>'db1',

																															'lionica_item_shop'=>'db1',
																															'lionica_map'=>'db1',
																															'lionica_maps'=>'db1',
																															'lionica_inventory'=>'db1',
																															'lionica_pet'=>'db1',
																															'lionica_drop'=>'db1',
																															'lionica_guild'=>'db1',
																															'lionica_vender'=>'db1',
																															'lionica_farm'=>'db1',
																															'lionica_logs'=>'db1',

																															'lionica_char'=>'db1',
																															'lionica_item'=>'db1',
																															'lionica_maps'=>'db1',
																															'lionica_clan'=>'db1',

																															'message'=>'db1',

																															'horo_phone'=>'db1',
																															'lotto'=>'db1',
																															'lotto_set'=>'db1',
																															'msg'=>'db1',
																															'msn'=>'db1',
																															'msn_rec'=>'db1',
																															'msn_province'=>'db1',
																															'music_request'=>'db1',
																															'music'=>'db1',
																															'movie'=>'db1',
																															'news'=>'db1',
																															'notify'=>'db1',
																															'pet'=>'db1',
																															'point'=>'db1',
																															'report'=>'db1',
																															'user_thank'=>'db1',
																															'video'=>'db1',
																															'video_cate'=>'db1',
																															'video_playlist'=>'db1',
																															'boyz_banner'=>'db1',
																															'lesbian_banner'=>'db1',
																															'shortener'=>'db1',
																															'autourl'=>'db1',
																															'game_namtoa'=>'db1',
																															'game_slave'=>'db1',
																															'game_lottery'=>'db1',
																															'game_lottery_answer'=>'db1',
																															'chat_thief'=>'db1',
																															'chat_online'=>'db1',
																															'chat_radio'=>'db1',
																															'logs'=>'db1',


																															'chat'=>'db_chat',

																															'line'=>'db3',
																															'line_hash'=>'db3',
																															'friend'=>'db3',
																															'event'=>'db3',
																															'event_vote'=>'db3',

																															'banner'=>'db6',
																															'banner_click'=>'db6',
																															'adsense_click'=>'db6',
																															'user'=>'db6',
																															'user_topvote'=>'db6',

																															'racing_team'=>'db6',
																															'car_brand'=>'db6',
																															'car_spec'=>'db6',
																															'car_gen'=>'db6',

																															'forum'=>'db6',
																															'forum_cate'=>'db6',
																															'forum_online'=>'db6',
																															'football_news'=>'db6',
																															'football_team'=>'db6',
																															'football_match'=>'db6',
																															'football_score'=>'db6',
																															'football_archer'=>'db6',
																															'football_league'=>'db6',
																															'football_video'=>'db6',
																															'football_game'=>'db6',
																															'football_teeded'=>'db6',
																															'football_lnw'=>'db6',

																															'place'=>'db6',
																															'place_bin'=>'db6',
																															'people'=>'db6',
																															'instagram'=>'db6',

																															'poem'=>'db6',

																															'image'=>'db6',
																															'wpbg'=>'db6',
																															'wpbg_domain'=>'db6',

																															'tags'=>'db6',
																															'tags_link'=>'db6',

																															'card_stats'=>'db6',

																															'weather'=>'db6',
																															'guess'=>'db6',
																															'guess_answer'=>'db6',
																															'guess_play'=>'db6',

																															'drama'=>'db6',
																															'drama_part'=>'db6',

																															'droid_news'=>'db6',

																															'sticker'=>'db6',
																															'sticker_icon'=>'db6',
																															'block_ip'=>'db6',

																															'saying'=>'db6',

																															'matching'=>'db6',
																															'matching_user'=>'db6',
																															'hidden_user'=>'db6',
																															'cooked'=>'db6',
																															'cooked_user'=>'db6',
																															'cooked_line'=>'db6',

																															'fbimage'=>'db6',
																															'fbimage2'=>'db6',

																															'appfriend'=>'db6',
																															'tvreturn'=>'db6',

																															'bux_logs'=>'db6',
																															'chat_key'=>'db6',

																															'racing_forum'=>'db6',
																															'racing_market'=>'db6',

																														]
																							]
															],
							'cache' => [
															'prefix'=>'bz_',
															'default' => [
																							'ca1'=>[
																													'host' => '192.168.1.134', // เครื่อง 1
																													'port' => 11211,
																							],
																							'ca2'=>[
																													'host' => '192.168.1.129', // เครื่อง 2
																													'port' => 11211,
																							],
															]
							],

							'social' => [
														'facebook'=>[
																							'appid'=>'xxxxxxxxxxxxxxxxxxx',
																							'secret'=>'xxxxxxxxxxxxxxxxxxx',
														],
														'google'=>[
																							'appid'=>'xxxxxxxxxxxxxxxxxxx',
																							'secret'=>'xxxxxxxxxxxxxxxxxxx',
																							'key'=>'xxxxxxxxxxxxxxxxxxx'
														],
														'twitter'=>[
																							'appid'=>'xxxxxxxxxxxxxxxxxxx',
																							'secret'=>'xxxxxxxxxxxxxxxxxxx',
														],
														'yahoo'=>[
																							'appid'=>'xxxxxxxxxxxxxxxxxxx',
																							'secret'=>'xxxxxxxxxxxxxxxxxxx',
																							'app_id'=>'xxxxxxxxxxxxxxxxxxx',
														],
														'live'=>[
																								'appid'=>'xxxxxxxxxxxxxxxxxxx',
																								'secret'=>'xxxxxxxxxxxxxxxxxxx'
														],
														'4sq'=>[
																								'appid'=>'xxxxxxxxxxxxxxxxxxx',
																								'secret'=>'xxxxxxxxxxxxxxxxxxx'
														],
														'instagram'=>[
																							'appid'=>'xxxxxxxxxxxxxxxxxxx',
																							'secret'=>'xxxxxxxxxxxxxxxxxxx'

														]
							],

							'album'=>[
														'1'=>'กราฟฟิก',
														'2'=>'กีฬา',
														'3'=>'ขำๆ',
														'4'=>'คนรักกัน',
														'5'=>'ครอบครัว',
														'6'=>'ความประทับใจ',
														'7'=>'เซ็กซี่',
														'8'=>'ท่องเที่ยว',
														'9'=>'ธรรมชาติ',
														'10'=>'เทคโนโลยี',
														'11'=>'นักเรียน นักศีกษา',
														'12'=>'มาเป็นแก๊งค์',
														'13'=>'ยานยนต์',
														'14'=>'สัตว์โลกน่ารัก',
														'15'=>'สาวสวย',
														'16'=>'สาวมั่น',
														'17'=>'หนุ่มหล่อ',
														'18'=>'ไม่หล่อ แต่เร้าใจ',
														'19'=>'อาหาร',
														'20'=>'อื่นๆ'
							],

							'gender'=>[
														'm'=>'ผู้ชาย',
														'f'=>'ผู้หญิง',
														'l'=>'เลสเบี้ยน',
														'b'=>'ทอม',
														'g'=>'เกย์',
														't'=>'สาวประเภทสอง',
														'u'=>'เพศที่ 3',
														'o'=>'ไม่เปิดเผย',
							],
							'relate'=>['','โสด','มีแฟนแล้ว','หมั้นแล้ว','แต่งงานแล้ว','ค่อนข้างอธิบายยาก','คบแบบไม่ผูกมัด','ม่าย','แยกกันอยู่','หย่าร้าง','แอบรัก','โดนทิ้ง','ถูกสวมเขา','รักแฟนชาวบ้าน','มีแฟนแล้วแต่อยากมีกิ๊ก'],
							'apps'=>[
													'boxzaracing.com'=>[
																										'uri'=>'http://oauth.boxzaracing.com/',
																										'secret'=>'xxxxxxxxxxxxxxxxxxx',
																									],
													'doodroid.com'=>[
																										'uri'=>'http://oauth.doodroid.com/',
																										'secret'=>'xxxxxxxxxxxxxxxxxxx',
																									],
													'boxzacar.com'=>[
																										'uri'=>'http://oauth.boxzacar.com/',
																										'secret'=>'xxxxxxxxxxxxxxxxxxx',
																									],
													'autocar.in.th'=>[
																										'uri'=>'http://oauth.autocar.in.th/',
																										'secret'=>'xxxxxxxxxxxxxxxxxxx',
																									],
													'teededball.com'=>[
																										'uri'=>'http://oauth.teededball.com/',
																										'secret'=>'xxxxxxxxxxxxxxxxxxx',
																									]
							],

							'upload'=>[
															's1'=>'http://115.178.60.122:8088/s1',
															's2'=>'http://115.178.60.123:8088/s2',
															's3'=>'http://115.178.60.124:8088/s3',
							]
];

?>

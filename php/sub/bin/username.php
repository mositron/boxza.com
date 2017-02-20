<?php


$text='#ทดสอบ#ลอง#เทส

#บอบบ
บบบบ
@positron @nut @best @test @@@@testtt@boxza @bo
#ซื่อบื้อ #โรงเรียนเปิด #มากที่อยู่#รู้นะ

http://boxza.com/positron#last
http://boxza.com/positron/s?w=1#last
http://boxza.com/positron/#last
http://boxza.com/positron/?#last

#er[sdfo0-123#asd\';sd-"sdf#3####adasd

"#ทดสอบ นะครับ" #"เทส เฉยๆ"
#sfsdf เทส



';


			if(preg_match_all("/\@(([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1}))/",$text,$out, PREG_PATTERN_ORDER))
			{
				if($out[1]&&is_array($out[1]))
				{
					foreach($out[1] as $v)
					{
						
					}
				}
			}
			print_r($out);

?>
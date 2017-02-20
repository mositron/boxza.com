<?php
class link
{

	public function __construct()
    {
    
    
    }
    
    public static function news($n)
	{
		if($n['exl'])
		{
			return 	$n['url'];
		}
		
		if($n['c']==2)
		{
			$l=array(
							1=>'online',
							2=>'web',
							3=>'pc',
							4=>'console',
							5=>'mobile'
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://game.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://game.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==3)
		{
			$l=array(
							1=>'news',
							2=>'tips',
							3=>'knowledge',
							4=>'gadget',
							5=>'apps'
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://tech.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://tech.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==4)
		{
			$l=array(
							1=>'gossip',
							2=>'news',
							3=>'video',
							4=>'event',
							5=>'hollywood',
							6=>'asian',
							7=>'drama',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://entertain.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://entertain.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==5)
		{
			return 'http://movie.boxza.com/news/'.$n['_id'];
		}
		elseif($n['c']==9)
		{
			return 'http://politic.boxza.com/news/'.$n['_id'];
		}
		elseif($n['c']==11)
		{
			$l=array(
							1=>'thailand',
							2=>'england',
							3=>'spain',
							4=>'italy',
							5=>'germany',
							6=>'france',
							7=>'other',
							8=>'worldcup',
							9=>'analyze',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://www.teededball.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://www.teededball.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==12)
		{
			$l=array(
							-1=>'promotion',
							-2=>'maintenance',
							-3=>'center',
							-4=>'auto',
							-5=>'motorcycle',
							-6=>'motorexpo',
							3=>'audi',
							5=>'bmw',
							7=>'chevrolet',
							8=>'citroen',
							57=>'daihatsu',
							12=>'fiat',
							13=>'ford',
							14=>'honda',
							15=>'hyundai',
							16=>'isuzu',
							17=>'jaguar',
							69=>'jeep',
							18=>'kia',
							20=>'land-rover',
							21=>'lexus',
							24=>'mazda',
							25=>'mercedes-benz',
							26=>'mini',
							27=>'mitsubishi',
							30=>'nissan',
							31=>'peugeot',
							32=>'porsche',
							33=>'proton',
							88=>'rover',
							89=>'saab',
							90=>'seat',
							37=>'ssangyong',
							38=>'subaru',
							39=>'suzuki',
							40=>'tata',
							42=>'toyota',
							43=>'volkswagen',
							44=>'volvo'
						);
			if(isset($l[$n['cs']]))
			{
				return 'http://www.autocar.in.th/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://www.autocar.in.th/news/'.$n['_id'];
			}
		}
		elseif($n['c']==14)
		{
			$l=array(		
							1=>'bedroom',
							2=>'kidsroom',
							3=>'livingroom',
							4=>'bathroom',
							5=>'kitchen',
							6=>'appliances',
							7=>'condo',
							8=>'office',
							9=>'idea',
							10=>'garden',
							11=>'fengshui',
							12=>'houseplan',
							13=>'homeloan',
							14=>'1floor',
							15=>'2floors',
							16=>'pretty',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://home.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://home.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==15)
		{
			$l=array(
							1=>'taste',
							2=>'nightlife',
							3=>'sea',
							4=>'mountain',
							5=>'abroad',
							6=>'thai',
							7=>'bangkok',
							8=>'tips',
							9=>'festival'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://travel.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://travel.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==16)
		{
			$l=array(
							1=>'mom',
							2=>'baby',
							3=>'food',
							4=>'tale',
							5=>'name',
							6=>'star'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://baby.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://baby.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==17)
		{
			$l=array(
							1=>'plan',
							2=>'ceremony',
							3=>'dress',
							4=>'ring',
							5=>'card',
							6=>'flower',
							7=>'love',
							8=>'gift',
							9=>'star'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://wedding.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://wedding.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==18)
		{
			$l=array(
							1=>'dog',
							2=>'cat',
							3=>'aquatic',
							4=>'poultry',
							5=>'animal'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://pet.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://pet.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==19)
		{
			$l=array(
								1=>'admission',
								2=>'examination',
								3=>'guidance',
								4=>'news',
								5=>'learn',
								5=>'scholarship',
								7=>'star'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://education.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://education.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==20)
		{
			$l=array(
								1=>'daily',
								2=>'love',
								3=>'torot',
								4=>'monthly',
								5=>'charactor',
								6=>'dream',
								7=>'yearly'															
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://horo.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://horo.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==21)
		{
			$l=array(
								1=>'forecast',
								2=>'warning'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://weather.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://weather.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==22)
		{
			$l=array(
								1=>'lucky'
				);
			if(isset($l[$n['cs']]))
			{
				return 'http://lotto.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://lotto.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==23)
		{
			$l=array(
							1=>'news',
							2=>'fitness',
							3=>'disease',
							4=>'herbal',
							5=>'food',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://health.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://health.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==24)
		{
			return 'http://music.boxza.com/news/'.$n['_id'];
		}
		elseif($n['c']==25)
		{
			$l=array(
							1=>'news',
							2=>'program',
							5=>'video',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://asiangames.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://asiangames.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==26)
		{
			$l=array(
							1=>'news',
							2=>'series',
							3=>'video',
							4=>'photo',
							5=>'music',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://korea.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://korea.boxza.com/news/'.$n['_id'];
			}
		}
		elseif($n['c']==27)
		{
			$l=array(
							1=>'review',
							2=>'wedding',
							3=>'healthy',
							4=>'howto',
							5=>'fashion',
							6=>'news',
			);
			if(isset($l[$n['cs']]))
			{
				return 'http://beauty.boxza.com/'.$l[$n['cs']].'/'.$n['_id'];
			}
			else
			{
				return 'http://beauty.boxza.com/news/'.$n['_id'];
			}
		}
		else
		{
			return 'http://news.boxza.com/view/'.$n['_id'];
		}
	}

}
?>
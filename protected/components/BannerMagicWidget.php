<?php
/**
 * Class BannerMagicWidget
 * useing <?php $this->wiget('BannerMagicWidget');?>
 */
class BannerMagicWidget extends CWidget{
	public function run(){
		$random = rand(1,3);
		if($random == 1){
			$advert = 'advert1.jpg';
		}elseif($random == 2){
			$advert = 'advert2.jpg';
		}else{
			$advert = 'advert3.jpg';
		}
		$this->render('bannermagic', array(
			'advert'=> $advert,
		));
	}
}
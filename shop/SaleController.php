<?php
namespace backend\Controllers;
set_time_limit(0);
use Yii;
use app\models\Sale;
use app\models\SaleSearch;
use app\models\SaleBrand;
use app\models\SaleSite;
use app\models\SaleCategoryCate;
use app\models\Setting;
use yii\helpers\Common;
use yii\helpers\Image_moo;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller {
	public $layout = 'main';
	public $enableCsrfValidation = false;
	public function behaviors() {
		return [
		'verbs' => [
		'class' => VerbFilter::className(),
		'actions' => [
		'delete' => ['get'],
		],
		],
		];
	}
	/**
     * Lists all Sale models.
     * @return mixed
     */
	public function actionIndex() {
		$searchModel = new SaleSearch();
		list($pages,$model) = $searchModel->search(Yii::$app->request->queryParams);
		$search_type=0;
		$keyword =trim(Yii::$app->request->get("keyword"));
		$site =trim(Yii::$app->request->get("site"));
		$category =trim(Yii::$app->request->get("category"));
		$brand =trim(Yii::$app->request->get("brand"));
		$is_show =trim(Yii::$app->request->get("is_show"));
		if($keyword!=""  || $category!="" || $site!="" || $brand!=""  || $is_show!="")
		$search_type=1;
		$sale = Sale::find()->orderBy("id desc")->limit(1)->one();
		$search_value=array("keyword"=>$keyword,"site"=>$site,"category"=>$category,"brand"=>$brand,"is_show"=>$is_show);
		return $this->render('index', [
		'model' => $model,
		'pages' => $pages,
		'search_value' =>$search_value,
		'search_type' => $search_type,
		'sale' => $sale,
		'CsrfToken' => Yii::$app->getRequest()->getCsrfToken(),
		'category_list_site' => Sale::getCategoryListSite(),
		'category_list_category' => Sale::getCategoryListCategory(),
		'category_list_brand' => Sale::getCategoryListBrand(),
		]);
	}
	public function actionCategoryMoreCategory()
	{
		//延迟05.秒
		for($j=0;$j<1000000;$j++)
		{
		}
		$str="";
		$show_categroy=Sale::getCategoryListCategory();
		$i=1;
		foreach ($show_categroy as $key=>$row) {
			$str.="<div class=\"cate_ajax\" attr_id=\"".$row->id."\"><span>".$row->name."</span></div>";
		}
		$tag_str = Yii::$app->request->post("tag_str");
		if($tag_str)
		{
			$tag_str=explode("_",$tag_str);
			foreach ($tag_str as $tag_value)
			{
				if(preg_match("/^\d+$/is",$tag_value))
				$str=str_replace("<div class=\"cate_ajax\" attr_id=\"".$tag_value."\">","<div class=\"cate_ajax cate_correct\" attr_id=\"".$tag_value."\">",$str);
			}
		}
		echo $str;die();
	}
	public function actionFetchSale($act)
	{
		if($act=="all" || $act=="yhd")
		$this->fetch_sale_yhd();
		if($act=="all" || $act=="jd")
		$this->fetch_sale_jd();
		if($act=="all" || $act=="beibei")
		$this->fetch_sale_beibei();
		if($act=="all" || $act=="jumei")
		$this->fetch_sale_jumei();
		if($act=="all" || $act=="mia")
		$this->fetch_sale_mia();
		if($act=="all" || $act=="dangdang")
		$this->fetch_sale_dangdang();
		if($act=="all" || $act=="suning")
		$this->fetch_sale_suning();
		if($act=="all" || $act=="yintai")
		$this->fetch_sale_yintai();
		if($act=="all" || $act=="vip")
		$this->fetch_sale_vipshop();
		if($act=="all" || $act=="kaola")
		$this->fetch_sale_kaola();
		if($act=="all" || $act=="feiniu")
		$this->fetch_sale_feiniu();
		if($act=="all" || $act=="mei")
		$this->fetch_sale_mei();

		$out=date("Y-m-d H:i:s",time())." success\r\n";
		die($out);
	}
	public function actionDataExport()
	{
		$postdate=time()-18000;
		$result=Sale::find()->where(['>','postdate',$postdate])->orderBy("id asc")->one();
		$dir_1=$dir=preg_replace("/upload\/sale\/(\d+)\/.*/is","\$1",$result->pic);
		$result=Sale::find()->where(['>','postdate',$postdate])->orderBy("id desc")->one();
		$dir_2=$dir=preg_replace("/upload\/sale\/(\d+)\/.*/is","\$1",$result->pic);
		$this->delete_dir(Yii::getAlias("@upload")."/data_export/".$dir_1);
		$this->delete_dir(Yii::getAlias("@upload")."/data_export/".$dir_2);
		@unlink(Yii::getAlias("@upload")."/data_export/sql.sql");
		$result=Sale::find()->where(['>','postdate',$postdate])->orderBy("id asc")->all();
		$str="";
		foreach($result as $row)
		{
			$str.="INSERT INTO `site_sale` VALUES (".$row->id.", '".addslashes($row->title)."', '".$row->site."', '".$row->category."', ".$row->brand.", '".$row->url."', '".$row->pic."', '".$row->logo_remote."', '".$row->discount."', ".$row->left_time.", ".$row->is_show.", ".$row->sort.", ".$row->sort_order.", ".$row->postdate.", ".$row->click.", '".$row->from_url."');\r\n";
			$pic=$row->pic;
			$dir=preg_replace("/upload\/sale\/(\d+)\/.*/is","\$1",$pic);
			@mkdir(Yii::getAlias("@upload")."/data_export/".$dir);
			@copy(Yii::getAlias("@site_url")."/frontend/web/".$pic,Yii::getAlias("@upload")."/data_export/".$dir."/".substr($pic,strrpos($pic,"/")+1));
		}
		file_put_contents(Yii::getAlias("@upload")."/data_export/sql.sql",$str);
		die('Export success');
	}
	public function delete_dir($dirName){
		if(is_dir($dirName)){
			if ($handle = opendir("$dirName")){
				while (false!==($item = readdir($handle))){
					if ($item!="." && $item!="..") {
						if (is_dir("$dirName/$item")) {
							$this->delete_dir("$dirName/$item");
						} else {
							unlink("$dirName/$item");
						}
					}
				}
				closedir($handle);
				@rmdir($dirName);

			}
		}
	}
	public function actionFetchSaleAutoMatch()
	{
		$i=0;
		$postdate=time()-84000*1;
		//$result=Sale::find()->select(['id','title','category','brand'])->where(['is_show'=>2])->andWhere(['brand'=>0])->andWhere(['>','left_time',time()])->andWhere(['>','postdate',$postdate])->orderBy("id desc")->all();
		$result=Sale::find()->select(['id','title','category','brand'])->where(['is_show'=>2])->andWhere(['>','left_time',time()])->andWhere(['>','postdate',$postdate])->orderBy("id desc")->all();
		foreach ($result as $row)
		{
			$name=strtolower($row->title);
			$sale_brand=SaleBrand::findBySql('SELECT id,name,ename,category,length(name) as n FROM site_sale_brand order by n desc')->all();
			if(($row->category)=='' || $row->category==",")
			{
				$cate=$this->auto_match_category($name,$row->id);
				if($cate>0)
				{
					$model = $this->findModel($row->id);
					$model->category=",".$cate.",";
					$model->save();
				}
			}
			foreach ($sale_brand as $row_brand)
			{
				if($row_brand->name)
				{
					if(!(strpos($name,strtolower($row_brand->name))===FALSE))
					{
						$model = $this->findModel($row->id);
						$model->brand=$row_brand->id;
						$model->category=($cate>0) ? ",".$cate."," : $row_brand->category;
						$model->save();
						$i++;
						break;
					}
				}
				if($row_brand->ename)
				{
					if(!(strpos($name,strtolower($row_brand->ename))===FALSE))
					{
						$model = $this->findModel($row->id);
						$model->brand=$row_brand->id;
						$cate=(isset($cate)) ? $cate : 0;
						$model->category=($cate>0) ? ",".$cate."," : $row_brand->category;
						$model->save();
						$i++;
						break;
					}
				}
				/*$this->auto_match_title($row->name,$row->id);
				if($row->ename)
				$this->auto_match_title($row->ename,$row->id);*/
			}
			$model = $this->findModel($row->id);
			if(!empty($model->brand) || !empty($model->category))
			{
				if($this->check_remote_file_exists(Yii::getAlias("@site_url")."/frontend/web/".$model->pic))
				{
					$model->is_show=1;
					$model->save();
				}

			}

			/*if(!(strpos($name,strtolower($keyword))===FALSE) && $brand_id!=2036)
			{
			var_dump($name);
			var_dump($keyword);
			die();
			$model = $this->findModel($row->id);
			$model->brand=$brand_id;
			$model->save();
			$i++;
			if(($row->category)=='' || $row->category==",")
			{
			$this->auto_match_category($name,$row->id);
			}
			}
			else
			{
			continue;
			}*/
		}


		/*$sale_brand=SaleBrand::findBySql('SELECT id,name,ename,length(name) as n FROM site_sale_brand order by n desc')->all();
		foreach ($sale_brand as $row)
		{
		$this->auto_match_title($row->name,$row->id);
		if($row->ename)
		$this->auto_match_title($row->ename,$row->id);
		}*/
		die("succss");
	}
	function check_remote_file_exists($url) {
		$curl = curl_init($url);
		// 不取回数据
		curl_setopt($curl, CURLOPT_NOBODY, true);
		$result = curl_exec($curl);
		$found = false;
		// 如果请求没有发送失败
		if ($result !== false) {
			// 再检查http响应码是否为200
			$statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			if ($statusCode == 200) {
				$found = true;
			}
		}
		curl_close($curl);
		return $found;
	}
	public function auto_match_category($name,$sale_id)
	{
		//1服装 2鞋包 3美妆 4配饰 5母婴 6家电 7运动 8家居 9数码 10百货 11电脑
		$cate=array(
		5=>array("童装","儿童服饰","童鞋","童车","宝宝","婴童","儿童","母婴","男童","女童","纸尿裤","奶粉","玩具","孕妈","产妇","推车","益智","月子服","小湿巾","卫生巾","NUK","孕妇","布朗博士","俏妈","宝贝","辅食","婴幼儿","孕装","青蛙王子","棒棒猪","妈妈育儿","婴儿服饰"),
		1=>array("女装","韩风","内衣","男装","春装"),
		2=>array("鞋履","女鞋","男鞋","雪地靴","靴子","UGG","鞋子","箱包","拉杆箱","包包","女包","男包","手袋","达芙妮","花花公子","简佰格","兔子包"),
		3=>array("肌肤","保湿","护肤","美容","面部","香水","美肌","美白","护发","化妆","雅诗兰黛","彩妆","兰蔻","倩碧","OLAY","雅漾","多芬","欧莱雅","我的美丽日记","秀发","面膜","精油","美发","碧欧泉","防晒","思亲肤","眼膜"),
		4=>array("配饰","腕表","手表","Accessory","眼镜","围巾","饰品","墨镜","太阳镜","天梭","镜架","卡西欧","女表","男表","发饰","琥珀","首饰"),
		6=>array("家电","电器","车载"),
		7=>array("运动鞋","跑步鞋","耐克","阿迪达斯","睡袋","体育用品","木林森","网羽","运动","阿迪","探拓","体感机"),
		8=>array("家居","收纳","餐具","水杯","文玩","家纺","清洗","伊维宝"),
		9=>array("U盘","硬盘"),
		10=>array("百货","手电筒","咖啡","营养早餐","拉蒙","酒水"),
		11=>array("电脑","笔记本"),
		);
		foreach($cate as $key=>$value)
		{
			foreach($value as $keyword)
			{
				if(!(strpos($name,strtolower($keyword))===FALSE))
				{
					/*$model = $this->findModel($sale_id);
					$model->category=",".$key.",";
					$model->is_show=1;
					$model->save();*/
					return $key;
				}
			}
		}
		return 0;
	}
	public function  auto_match_title($keyword,$brand_id)
	{
		$i=0;
		$postdate=time()-54000;
		$result=Sale::find()->select(['id','title','category','brand'])->where(['is_show'=>2])->andWhere(['brand'=>0])->andWhere(['>','left_time',time()])->andWhere(['>','postdate',$postdate])->orderBy("id desc")->all();
		foreach ($result as $row)
		{
			$name=strtolower($row->title);
			if(!(strpos($name,strtolower($keyword))===FALSE) && $brand_id!=2036)
			{
				var_dump($name);
				var_dump($keyword);
				die();
				$model = $this->findModel($row->id);
				$model->brand=$brand_id;
				$model->save();
				$i++;
				if(($row->category)=='' || $row->category==",")
				{
					$cate=$this->auto_match_category($name,$row->id);
					if($cate==0)
					{

					}
				}
			}
			else
			{
				continue;
			}
		}
	}
	public function fetch_sale_vipshop()
	{
		//delete FROM `site_sale` WHERE id>1159
		$count=0;
		$sort_order=303;
		$sort=$this->get_sort();
		$content=file_get_contents("http://www.vip.com");
		preg_match_all("/VIPTE.brandData.part1[^=]*=[^\[]*(.*\}\}\])/is",$content,$list);
		$k=0;
		if(@$list[1][0])
		{
			$info=json_decode($list[1][0]);
			foreach($info as $row)
			{
				$url=preg_replace("/\?ff=.*$/is","\$1",$row->link);
				$end_time=@$row->isEndTime->end_time;
				if($this->not_sale_exit($url) && intval($end_time)>time() && $k<30)
				{
					$model = new Sale();
					$model->title = str_replace("唯品会","",$row->name);
					$model->discount = preg_replace("/<span[^>]*>(.*)<\/span>/is","<em>\$1</em>",$row->discount);
					$model->logo_remote = $row->img;
					$model->left_time = $end_time;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$model->is_show = 2;

					$pic=$this->save_pic($row->img);

					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$Image_moo->load("../../..".Yii::getAlias("@base_url")."/".$pic)->crop(200,0,640,180)->save("../../..".Yii::getAlias("@base_url")."/".$new_crop);
					$model->pic=$new_crop;
					@unlink("../../..".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
					$k++;
				}
			}
			$this->siteUpdateCount('vip',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_feiniu()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://sale.feiniu.com/";
		$site_temai="http://sale.feiniu.com/activity-789522997103156.html";
		//$content=Common::curl_get_content($site_temai);
		$content=file_get_contents($site_temai);
		// 		<div class="m-progroup  clearfix">
		// <a class="pic img-lazyload" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank"><img class="brandImg" src="http://mm.bst.126.net/images/blank.gif" lazyload="http://haitao.nosdn1.127.net/ik40eir818_960_480.jpg?imageView&amp;thumbnail=660x330" width="660" height="330" title="Merries"></a>				            <a class="foreshowbox" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank">
		// 				              <div class="proinfo">
		// 					              <img class="brandLogo w-brand" src="http://haitao.nos.netease.com/ii71o8pm45_120_120.jpg?imageView&amp;thumbnail=120x120" title="Merries">
		// 					              <h3 class="tit" title="Merries">Merries</h3>
		// 					              <p class="desc" title="Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。">Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。</p>
		// 					              <p class="price" title="花王纸尿裤低至87元/件">花王纸尿裤低至87元/件</p>
		// 					              <p class="timerbox brandTime end" time="2016-2-15 23:59:59">
		preg_match_all("/<div class=\"m-progroup  clearfix\"[^>]*>[^<]*<a class=\"pic[^\"]*\" href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img class=\"brandImg\" src=[\"|'][^\"']*[\"|'] lazyload=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<\/a>[^<]*<a [^>]*>[^<]*<div class=\"proinfo\"[^>]*>[^<]*<img [^>]*>[^<]*<h3 class=\"tit\"[^>]*>([^<]*)<\/h3>[^<]*<p class=\"desc\"[^>]*>[^<]*<\/p>[^<]*<p class=\"price\"[^>]*>([^<]*)<\/p>[^<]*<p class=\"timerbox brandTime end\" time=\"([^\"]*)\">/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site_temai.$url;
				$url=preg_replace("/\?int.*/is","",$url);
				if($this->not_sale_exit($url))
				{
					$discount="7.5折起";
					$title1=trim($list[3][$key]);
					$title2=trim($list[4][$key]);
					$title1_temp=substr($title1,strrpos($title1," ")+1);
					$title=$title1.str_replace($title1_temp,"",$title2);
					$model = new Sale();
					$model->title = $title;
					$model->discount = $discount;
					$model->logo_remote =$list[2][$key];
					$model->left_time = strtotime($list[5][$key]);
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic(trim($list[2][$key]));
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,30,660,300)->resize(440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('feiniu',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_mei()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://www.mei.com/";
		$site_temai="http://www.mei.com/index.html";
		//$content=Common::curl_get_content($site_temai);
		$content=file_get_contents($site_temai);
		// 		<div class="m-progroup  clearfix">
		// <a class="pic img-lazyload" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank"><img class="brandImg" src="http://mm.bst.126.net/images/blank.gif" lazyload="http://haitao.nosdn1.127.net/ik40eir818_960_480.jpg?imageView&amp;thumbnail=660x330" width="660" height="330" title="Merries"></a>				            <a class="foreshowbox" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank">
		// 				              <div class="proinfo">
		// 					              <img class="brandLogo w-brand" src="http://haitao.nos.netease.com/ii71o8pm45_120_120.jpg?imageView&amp;thumbnail=120x120" title="Merries">
		// 					              <h3 class="tit" title="Merries">Merries</h3>
		// 					              <p class="desc" title="Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。">Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。</p>
		// 					              <p class="price" title="花王纸尿裤低至87元/件">花王纸尿裤低至87元/件</p>
		// 					              <p class="timerbox brandTime end" time="2016-2-15 23:59:59">
		preg_match_all("/<div class=\"m-progroup  clearfix\"[^>]*>[^<]*<a class=\"pic[^\"]*\" href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img class=\"brandImg\" src=[\"|'][^\"']*[\"|'] lazyload=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<\/a>[^<]*<a [^>]*>[^<]*<div class=\"proinfo\"[^>]*>[^<]*<img [^>]*>[^<]*<h3 class=\"tit\"[^>]*>([^<]*)<\/h3>[^<]*<p class=\"desc\"[^>]*>[^<]*<\/p>[^<]*<p class=\"price\"[^>]*>([^<]*)<\/p>[^<]*<p class=\"timerbox brandTime end\" time=\"([^\"]*)\">/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site_temai.$url;
				$url=preg_replace("/\?int.*/is","",$url);
				if($this->not_sale_exit($url))
				{
					$discount="7.5折起";
					$title1=trim($list[3][$key]);
					$title2=trim($list[4][$key]);
					$title1_temp=substr($title1,strrpos($title1," ")+1);
					$title=$title1.str_replace($title1_temp,"",$title2);
					$model = new Sale();
					$model->title = $title;
					$model->discount = $discount;
					$model->logo_remote =$list[2][$key];
					$model->left_time = strtotime($list[5][$key]);
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic(trim($list[2][$key]));
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,30,660,300)->resize(440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('mei',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_kaola()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://www.kaola.com/";
		$site_temai="http://www.kaola.com/activity/brandGroup.html";
		//$content=Common::curl_get_content($site_temai);
		$content=file_get_contents($site_temai);
		// 		<div class="m-progroup  clearfix">
		// <a class="pic img-lazyload" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank"><img class="brandImg" src="http://mm.bst.126.net/images/blank.gif" lazyload="http://haitao.nosdn1.127.net/ik40eir818_960_480.jpg?imageView&amp;thumbnail=660x330" width="660" height="330" title="Merries"></a>				            <a class="foreshowbox" href="http://www.kaola.com/activity/brandGroup/2016020321BRAND58916368.html" data-param="?from=ongoing" target="_blank">
		// 				              <div class="proinfo">
		// 					              <img class="brandLogo w-brand" src="http://haitao.nos.netease.com/ii71o8pm45_120_120.jpg?imageView&amp;thumbnail=120x120" title="Merries">
		// 					              <h3 class="tit" title="Merries">Merries</h3>
		// 					              <p class="desc" title="Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。">Merries 花王纸尿裤是日本花王株式会社Kao Corporation旗下的王牌产品，1983年花王推出日本第一款全面通气型Merries纸尿裤，就大受好评，现已连续8年日本销量No.1，畅销海内外，是深受消费者青睐的“优质品牌“。综合性能很高，无论是柔软性、干爽性、包裹感、立体舒适感等各方面都颇有口碑。在中国妈妈育儿圈里人气一直居高不下，《爸爸回来了》李小璐、贾乃亮之女甜馨日常纸尿裤品牌。</p>
		// 					              <p class="price" title="花王纸尿裤低至87元/件">花王纸尿裤低至87元/件</p>
		// 					              <p class="timerbox brandTime end" time="2016-2-15 23:59:59">
		preg_match_all("/<div class=\"m-progroup  clearfix\"[^>]*>[^<]*<a class=\"pic[^\"]*\" href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img class=\"brandImg\" src=[\"|'][^\"']*[\"|'] lazyload=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<\/a>[^<]*<a [^>]*>[^<]*<div class=\"proinfo\"[^>]*>[^<]*<img [^>]*>[^<]*<h3 class=\"tit\"[^>]*>([^<]*)<\/h3>[^<]*<p class=\"desc\"[^>]*>[^<]*<\/p>[^<]*<p class=\"price\"[^>]*>([^<]*)<\/p>[^<]*<p class=\"timerbox brandTime end\" time=\"([^\"]*)\">/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site_temai.$url;
				$url=preg_replace("/\?int.*/is","",$url);
				if($this->not_sale_exit($url))
				{
					$discount="7.5折起";
					$title1=trim($list[3][$key]);
					$title2=trim($list[4][$key]);
					$title1_temp=substr($title1,strrpos($title1," ")+1);
					$title=$title1.str_replace($title1_temp,"",$title2);
					$model = new Sale();
					$model->title = $title;
					$model->discount = $discount;
					$model->logo_remote =$list[2][$key];
					$model->left_time = strtotime($list[5][$key]);
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic(trim($list[2][$key]));
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,270)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,20,440,200)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;

					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('kaola',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_yintai()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://www.yintai.com";
		$site_temai="http://temai.yintai.com";
		//$content=Common::curl_get_content($site_temai);
		$content=file_get_contents($site_temai);
		preg_match_all("/<li>[^<]*<div class=\"s-limitIngImg\"[^>]*>[^<]*<a href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img[^>]*>[^<]*<\/a>[^<]*<\/div>[^<]*<div class=\"s-limitIngInfo[^>]*>[^<]*<div class=[^>]*>[^<]*<strong[^>]*>[^<]*<\/strong>[^<]*<span[^>]*>[^<]*<\/span>[^<]*<em[^>]*>[^<]*<\/em>[^<]*<strong[^>]*>([^<]*)<\/strong>[^<]*<span[^>]*>([^<]*)<\/span>[^<]*<\/div>[^<]*<div class=\"s-limit[^>]*>[^<]*<a [^>]*>([^<]*)<\/a>[^<]*<\/div>[^<]*<\/div>[^<]*<\/li>/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site_temai.$url;
				$url=preg_replace("/\?int.*/is","",$url);
				if($this->not_sale_exit($url))
				{
					$discount="<em>".$list[2][$key].str_replace("&nbsp;折","",$list[2][$key])."</em>折";
					$title=trim($list[4][$key]);
					$info=Common::curl_get_content($url);
					preg_match_all("/<div class=\"yt-offer-bar-b\">[^<]*<img src=[\"|']([^\"']*)[\"|']/is",$info,$list1);
					preg_match_all("/\d+:\d+:\d+\-(\d+\/\d+\/\d+ \d+:\d+:\d+)/is",$info,$list2);
					$model = new Sale();
					$model->title = $title;
					$model->discount = $discount;
					$model->logo_remote =$list1[1][0];
					$model->left_time = strtotime($list2[1][0]);
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic(trim($list1[1][0]));


					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();

					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(882,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(340,0,780,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);

					$model->is_show = 2;
					$model->pic=$pic;
					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('yintai',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_beibei()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://www.beibei.com/page/n_0/1.html";
		$content=file_get_contents($site);
		preg_match_all("/<a class=\"m-sale[^h]*how[^h]*href=\"([^\"]*)\"[^>]*>[^<]*<div class=\"m-sbanner\"[^>]*>[^<]*<img class=\"sbanner lazy\" src=\"[^\"]*\" style=\"[^\"]*\" data-src=\"([^\"]*)\" alt=\"([^\"]*)\"[^>]*>[^<]*<\/div>[^<]*<div class=\"m-detail-cont\"[^>]*>[^<]*<div class=\"countdown-cont\"[^>]*>[^<]*<i class=\"iconfont\"[^>]*>[^<]*<\/i>[^<]*<span class=\"timer J_timer\" data-begin=\"[^\"]*\" data-end=\"([^\"]*)\"[^>]*>[^<]*<\/span>[^<]*<\/div>[^<]*<div class=\"m-detail\"[^>]*>[^<]*<h3[^>]*>[^<]*<span[^>]*>[^<]*<\/span>[^<]*<\/h3>[^<]*<div class=\"description\"[^>]*>[^<]*<\/div>[^<]*<\/div>[^<]*(<div class=\"u-people\"[^>]*>[^<]*<span[^>]*>[^<]*<\/span>[^<]*<\/div>|)[^<]*<span class=\"u-enter-btn\"[^>]*>[^<]*<span class=\"f-price-font\"[^>]*>([^<]*)<\/span>([^<]*)<\/span>/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site.$url;
				$time_end=$list[4][$key];
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = $list[3][$key];
					$model->discount = "<em>".$list[6][$key]."</em>".trim(str_replace(array("特卖","&gt;"),"",$list[7][$key]));
					$model->logo_remote =$list[2][$key];
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($list[2][$key]);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,206)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,0,440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('beibei',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_yhd()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://s.yhd.com/mpSquidAjax/ajaxGetNewMingpinActivityList.do";
		$content=file_get_contents($site);
		preg_match_all("/<div class=\"dilay-item scale\" id=\"[^\"]*\" isStarted=\"[^\"]*\" data-activityId=\"[^\"]*\" data-startTime=\"[^\"]*\" data-endTime=\"([^\"]*)\"[^>]*>[^<]*<div class=\"dilay-item-pic\"[^>]*>[^<]*<a href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img class=\"scale-img\" src=[\"|'][^\"']*[\"|'] original=\"([^\"]*)\"[^>]*>[^<]*<\/a>[^<]*<div class=\"time\"[^>]*>[^<]*<div class=[^>]*>[^<]*<i[^>]*>[^<]*<\/i>[^<]*<\/div>[^<]*<div[^>]*>[^<]*<i class=\"sprite\"[^>]*>[^<]*<\/i>[^<]*<\/div>[^<]*<\/div>[^<]*<\/div>[^<]*<div class=\"dilay-item-info\"[^>]*>[^<]*<a [^>]*>[^<]*<div [^>]*>[^<]*<img [^>]*>[^<]*<\/div>[^<]*<div class=\"dilay-item-title\"[^>]*>[^<]*<h3[^>]*>([^<]*)<\/h3>[^<]*<p[^>]*>[^<]*<\/p>[^<]*<\/div>[^<]*<div class=\"dilay-item-discount\"[^>]*>[^<]*<h4[^>]*>[^<]*<strong[^>]*>([^<]*)<\/strong>([^<]*)<\/h4>/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[2] as $key=>$url)
			{
				$time_end=substr(trim($list[1][$key]),0,10);
				$pic=$list[3][$key];
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = trim($list[4][$key]);
					$model->discount = "<em>".trim($list[5][$key])."</em>".trim($list[6][$key]);
					$model->logo_remote =$pic;
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($pic);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,184)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,0,440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('yhd',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_jd()
	{
		$count=0;
		$sort_order=302;
		$sort=$this->get_sort();
		$site="http://red.jd.com/";
		$content=file_get_contents($site);
		$content=preg_replace("/<span class=\"follow\"[^>]*>[^<]*<b class=\"follow-bg\">[^<]*<\/b>[^<]*<span clstag=[^>]*>[^<]*<i[^>]*>[^<]*<\/i>[^<]*<\/span>[^<]*<\/span>/is","", $content);
		$content=preg_replace("/<div class=\"brand-logo\"[^>]*>[^<]*<a clstag=[^>]*>[^<]*<img [^>]*>[^<]*<\/a>[^<]*<\/div>/is","", $content);
		$content=preg_replace("/<img class=\"mi-icon\" src=[^>]*>[^<]*<\/img>/is","", $content);

		preg_match_all("/<div class=\"ml-item\"[^>]*>[^<]*<div class=\"mli-img\"[^>]*>[^<]*<a [^>]*>[^<]*<img data-original=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<\/a>[^<]*<\/div>[^<]*<div class=\"mli-info\"[^>]*>[^<]*<div class=\"brand-active\"[^>]*>[^<]*<a clstag=\"[^\"]*\"  href=[\"|']([^\"']*)[\"|'][^>]*>([^<]*)<\/a>[^<]*<span[^>]*>[^<]*<\/span>[^<]*<\/div>[^<]*<div class=\"brand-rebate\"[^>]*>[^<]*<span[^>]*>([^<]*)<\/span>[^<]*<strong[^>]*>([^<]*)<\/strong>[^<]*<span[^>]*>([^<]*)<\/span>[^<]*<\/div>[^<]*<div class=\"brand-surplustime\"[^>]*>[^<]*<div class=\"bs-box\"[^>]*>[^<]*<div class=\"bsb-con\"[^s]*secondcount=\"([^\"]*)\"[^>]*>/is",$content,$list);
		//var_dump($list);die();
		if(@$list[1])
		{
			foreach(@$list[2] as $key=>$url)
			{
				$url=(substr($url,0,2)=="//") ? "http:".$url : $url;
				$time_end=time()+$list[7][$key];
				$pic=(substr($list[1][$key],0,2)=="//") ? "http:".$list[1][$key] : $list[1][$key];
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = trim($list[3][$key]);
					$model->discount = "低至<em>".trim($list[5][$key])."</em>".$list[6][$key];
					$model->logo_remote =$pic;
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($pic);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(455,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(7,0,447,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('jd',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function siteUpdateCount($site_url,$count)
	{
		if($count>0)
		{
			$site_row=SaleSite::find()->where(['url'=>$site_url])->one();
			$model2 = SaleSite::findOne($site_row->id);
			$model2->count =$count;
			$model2->save();
		}
	}
	public function fetch_sale_jumei()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://pop.jumei.com/";
		$content=file_get_contents($site);
		preg_match_all("/<div class=\"pop_left_sorts\"[^>]*>[^<]*<div class=\"left_sorts_rank\"[^>]*>[^<]*<p class=\"logo\"[^>]*>[^<]*<img [^>]*>[^<]*<\/p>[^<]*<p class=\"notice tit[^>]*>[^<]*<\/p>[^<]*<p class=\"zhe[^>]*>[^<]*<span class=\"num\"[^>]*>([^<]*)<\/span>([^<]*)<\/p>[^<]*<p class=\"notice\">[^<]*<\/p>[^<]*<\/div>[^<]*<div class=\"left_img_box\"[^>]*>[^<]*<img original=\"([^\"]*)\"[^>]*>[^<]*<span class=[^>]*>[^<]*<\/span>[^<]*<\/div>[^<]*<div class=\"buyer_box\"[^>]*>[^<]*<div class=\"time_box\" diff=\"([^\"]*)\"[^>]*>[^<]*<\/div>[^<]*<div class=\"tit\"[^>]*>([^<]*)<\/div>[^<]*<\/div>[^<]*<a href=[\"|']([^\"']*)[\"|'][^>]*>/is",$content,$list);
		if(@$list[1])
		{
			foreach(@$list[6] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site.$url;
				if(strpos($url,"?from"))
				$url=$url=preg_replace("/\?from=.*/is","",$url);
				$time_end=time()+$list[4][$key];
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = $list[5][$key];
					$model->discount = "<em>".trim($list[1][$key])."</em>".$list[2][$key];
					$model->logo_remote =$list[3][$key];
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($list[3][$key]);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,216)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,0,440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('jumei',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_dangdang()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://v.dangdang.com/";
		$content=file_get_contents($site);
		$content=str_replace("data-original","src",$content);
		$content=iconv("gbk","utf-8",$content);
		preg_match_all("/<div class=\"list\"[^>]*>[^<]*<ul[^>]*>[^<]*<li[^>]*>[^<]*<a href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img[^s]*src=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<span class=\"shop_name\"[^>]*>([^<]*)<\/span>[^<]*<span class=\"time\"[^>]*>[^<]*<span overtype=\"5\" js=\"true\" action=\"countdown\" type=\"seckill\" class=\"time_hs\"  endvalue=\"([^\"]*)\"[^>]*>[^<]*<span sec=\"sep\"[^>]*>[^<]*<\/span>[^<]*<\/span>[^<]*<\/span>[^<]*<span class=\"left_shadow\"[^>]*>[^<]*<span class=\"img_logo\"[^>]*>[^<]*<img[^>]*>[^<]*<\/span>[^<]*<span class=\"shop_ad\"[^>]*>[^<]*<\/span>[^<]*<span class=\"price_z\"[^>]*>([^<]*)<span[^>]*>([^<]*)<\/span>/is",$content,$list);
		//var_dump($list);die();
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site.$url;
				$time_end=$list[4][$key];
				if($this->not_sale_exit($url) && intval($time_end)>time() && !strpos($list[3][$key],"尾品汇"))
				{
					$model = new Sale();
					$model->title = $list[3][$key];
					$model->discount = "<em>".trim($list[5][$key])."</em>".$list[6][$key];
					$model->logo_remote =$list[2][$key];
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($list[2][$key]);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(330,20,770,200)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('dangdang',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_suning()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://mp.suning.com";
		$content=file_get_contents($site);
		preg_match_all("/<li[^>]*>[^<]*<div class=\"fs-item\"[^>]*>[^<]*<div class=\"img-link\"[^>]*>[^<]*<a href=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<img[^s]*src=[\"|']([^\"']*)[\"|'][^>]*>[^<]*<\/a>[^<]*<\/div>[^<]*<div class=\"item-wrapper\"[^>]*>[^<]*<div class=\"item-head\"[^>]*>[^<]*<a [^>]*>[^<]*<img [^>]*>[^<]*<\/a>[^<]*<\/div>[^<]*<div class=\"item-info\"[^>]*>[^<]*<div class=\"item-title\"[^>]*>[^<]*<a [^>]*>[^<]*<span class=\"title1\"[^>]*>([^<]*)<\/span>[^<]*<span class=\"title2\"[^>]*>([^<]*)<\/span>[^<]*<\/a>[^<]*<\/div>[^<]*<p class=\"item-discount\"[^>]*>[^<]*<span[^>]*>([^<]*)<\/span>([^<]*)<\/p>[^<]*<p id=\"[^\"]*\" class=\"[^\"]*\" data-time-end=\"([^\"]*)\"[^>]*>/is",$content,$list);
		//<span class=\"title1\"[^>]*>([^<]*)<\/span>[^<]*<span class=\"title2\"[^>]*>[^<]*<\/span>[^<]*<p class=\"item-discount\">[^<]*<span[^>]*>([^<]*)<\/span>([^<]*)<\/p>[^<]*<p id=\"[^\"']*\" class=\"fs-time-left\" data-time-end=\"([^\"']*)\"[^>]*>
		//var_dump($list);die();
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site.$url;
				$time_end=strtotime($list[7][$key]);
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = $list[3][$key];
					$model->discount = "<em>".$list[5][$key]."</em>".$list[6][$key];
					$model->logo_remote =$list[2][$key];
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($list[2][$key]);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();

					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,226)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,0,440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('suning',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function fetch_sale_mia()
	{
		$count=0;
		$sort_order=300;
		$sort=$this->get_sort();
		$site="http://www.mia.com";
		$content=file_get_contents($site);
		preg_match_all("/<div class=\"ntblock\"[^>]*>[^<]*<div class=\"img[^>]*>[^<]*<a[^h]*href=\"([^\"]*)\"[^>]*>[^<]*<img src=\"[^\"]*\" data-src=\"([^\"]*)\" alt=\"([^\"]*)\"[^>]*>[^<]*<\/a>[^<]*<div[^>]*>[^<]*<\/div>[^<]*<\/div>[^<]*<div class=\"text\"[^>]*>[^<]*<div class=[^>]*>[^<]*<span id=\"counter_([\d]+)\"[^>]*>[^<]*<\/span>[^<]*<\/div>[^<]*<span class=\"price\"[^>]*>[^<]*<span class[^>]*>([^<]*)<\/span>([^<]*)<\/span>[^<]*<a [^>]*>[^<]*<\/a>[^<]*<\/div>[^<]*<\/div>/is",$content,$list);
		$time_info=file_get_contents("http://www.mia.com/instant/welcome/ajaxGetTimerInfo/");
		if(@$list[1])
		{
			foreach(@$list[1] as $key=>$url)
			{
				$url=(substr($url,0,4)=="http") ? $url : $site.$url;
				$sale_id=$list[4][$key];
				$time_end=preg_replace("/.*\"end\":\"([^\"]*)\",\"id\":\"".$sale_id."\".*/is","$1",$time_info);
				$time_end=strtotime($time_end);
				if($this->not_sale_exit($url) && intval($time_end)>time())
				{
					$model = new Sale();
					$model->title = $list[3][$key];
					$model->discount = "<em>".$list[5][$key]."</em>".$list[6][$key];
					$model->logo_remote =$list[2][$key];
					$model->left_time = $time_end;
					$model->from_url =  $url;
					$model->url = $url;
					$model->site = $this->get_site_id($url);
					$model->sort_order = $sort_order;
					$model->sort = $sort;
					$pic=$this->save_pic($list[2][$key]);
					$new_crop=substr($pic,0,strrpos($pic,"."))."c".substr($pic,strrpos($pic,"."));
					$Image_moo=new Image_moo();


					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->resize(440,192)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$sign=$Image_moo->load("../../../".Yii::getAlias("@base_url")."/".$pic)->crop(0,0,440,180)->save("../../../".Yii::getAlias("@base_url")."/".$pic,true);
					$model->is_show = 2;
					$model->pic=$pic;
					//@unlink("../../../".Yii::getAlias("@base_url")."/".$pic);
					/*$model->brand = $this->fetch_sale_match_brand($model->title);
					if($model->brand)
					$model->category = $this->fetch_sale_match_category($model->brand);*/
					$sign=$model->save();
					if(!$sign)
					{
						Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
					}
					$count++;
					$sort_order--;
					$sort_order=($sort_order<0) ? 0 : $sort_order;
				}
			}
			$this->siteUpdateCount('mia',$count);
		}
		$this->actionFetchSaleAutoMatch();
	}
	public function actionCategoryMoreCategoryClick()
	{
		$tag_str = Yii::$app->request->post("tag_str");
		$str=Sale::getCategoryCategory($tag_str);
		echo $str;die();
	}
	/**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     */
	public function actionView($id) {
		return $this->render('view', [
		'model' => $this->findModel($id),
		]);
	}
	public function actionFetch() {
		$sort_order=1000;
		$data=SaleCategoryCate::find()->orderBy("sort_order desc,id asc")->all();
		$sort=$this->get_sort();
		$url="http://temai.baidu.com/?time=".time();
		//$content=$this->curl_get_content($url);
		$content=Common::curl_get_content($url);
		preg_match_all("/ITUAN\.url\.ajaxMain[^\"]*\"([^\"]*)\"/is",$content,$list);
		$url_website=$list[1][0];
		foreach($data as $row_cate)
		{
			for($i=1;$i<4;$i++)
			{
				$url=$url_website."&cateid=".$row_cate->old_id."&page=".$i."&time=".time();
				Common::log("查看值url：".$url,Yii::getAlias("@upload")."/sale/log.txt");
				//$content=$this->curl_get_content($url);
				$content=Common::curl_get_content($url);
				$list=json_decode($content);
				$info=$list->list->areaA;
				if(!is_array($info))
				{
					Common::log("Url没数据：".$url,Yii::getAlias("@upload")."/sale/error.txt");
				}
				if(is_array($info))
				{
					foreach($info as $row)
					{
						$url = $this->get_curl_url($row->url);
						if($this->not_sale_exit($url) && intval($row->etime)>time())
						{
							$model = new Sale();
							$model->title = $row->title;
							$model->discount = $row->rebate;
							$model->logo_remote = $row->imgurl;
							$model->left_time = $row->etime;
							$from_url=$this->get_curl_url($row->url);
							$model->from_url = $row->url;
							$model->category = ",".$row_cate->id.",";
							$model->url = $url;
							$model->site = $this->get_site_id($model->url);
							$model->sort_order = $sort_order;
							$model->sort = $sort;
							$model->brand=0;
							//获取brand
							if(!empty($row->brandid))
							{
								$sale_row=SaleBrand::find()->where(['old_brand_id'=>$row->brandid])->one();
								if($sale_row)
								$model->brand = $sale_row->id;
							}
							//$model->brand = $sort_order;
							$model->is_show = 1;
							if(strpos($model->url,"union.click.jd.com"))
							$model->is_show = 2;
							//保存图片
							/*$sec =explode(" ",microtime());
							$filename=str_replace("0.","",$sec[1].$sec[0]);
							$pic_path=$this->get_upload_path();
							$new_pic=Yii::getAlias("@upload")."/sale/".$pic_path."/".$filename.substr($row->imgurl,strrpos($row->imgurl,"."));
							@copy($row->imgurl,$new_pic);
							$model->pic = "upload/sale/".$pic_path."/".$filename.substr($row->imgurl,strrpos($row->imgurl,"."));*/
							$model->pic=$this->save_pic($row->imgurl);
							//保存图片结束
							$sign=$model->save();
							if(!$sign)
							{
								Common::log("数据保存出错：".$url,Yii::getAlias("@upload")."/sale/error.txt");
							}
							$sort_order--;
							$sort_order=($sort_order<0) ? 0 : $sort_order;
							//var_dump($model->save());
						}
					}
				}
			}
		}

	}
	function get_sort()
	{
		$setting=Setting::find()->where(['id'=>1])->one();
		$setting=unserialize($setting->sort);
		if(date("Y-m-d",$setting["time"])==date("Y-m-d",time()))
		$sort=$setting["sort"];
		else
		{
			if (($model_setting = Setting::findOne(1)) !== null) {
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
			$sort=intval($setting["sort"])+1;
			$model_setting->sort=serialize(array("sort"=>$sort,"time"=>time()));
			$model_setting->save();
		}
		return $sort;
	}
	function save_pic($pic)
	{
		//保存图片
		$sec =explode(" ",microtime());
		$filename=str_replace("0.","",$sec[1].$sec[0]);
		$pic_path=$this->get_upload_path();
		$new_pic=Yii::getAlias("@upload")."/sale/".$pic_path."/".$filename.substr($pic,strrpos($pic,"."));
		$new_pic=preg_replace("/\?.*/is","",$new_pic);
		$new_pic=preg_replace("/!.*/is","",$new_pic);
		@copy($pic,$new_pic);
		$pic=preg_replace("/\?.*/is","",$pic);
		$pic=preg_replace("/!.*/is","",$pic);
		return "upload/sale/".$pic_path."/".$filename.substr($pic,strrpos($pic,"."));
		//保存图片结束
	}
	function get_site_id($url)
	{
		preg_match_all("/\.?([\w|-]*)\.(com.cn|net.cn|gov.cn|org.cn|com|net|cn|org|asia|tel|mobi|me|tv|biz|cc|name|info)/is", $url, $list);
		$url_short=@$list[1][0];
		$sale_row=SaleSite::find()->where(['url'=>$url_short])->one();
		if($sale_row)
		return (string)$sale_row->id;
		else
		return "1";
	}
	//每个文件夹保存一定的图片
	function get_upload_path($dir="sale",$max=5000)
	{
		$dir=Yii::getAlias("@upload")."/".$dir;
		$content_txt=file_get_contents($dir."/info.txt");
		$array=unserialize($content_txt);
		$return=1;
		if(empty($array) || !is_array($array))
		{
			$array=array(1=>1);
			@mkdir($dir."/1");
		}
		else
		{
			$array_len=count($array);
			$signal=false;
			for($i=1;$i<$array_len;$i++)
			{
				if($array[$i]<$max)
				{
					$array[$i]=$array[$i]+1;
					$signal=true;
					$return=$i;
					break;
				}
			}
			if($signal===false)
			{
				if($array[$array_len]<$max)
				{
					if(!file_exists($dir."/".$array_len))
					@mkdir($dir."/".$array_len);
					$array[$array_len]=$array[$array_len]+1;
				}
				else
				{
					$array[$array_len+1]=1;
					@mkdir($dir."/".intval($array_len+1));
				}
				$return=count($array);
			}
		}
		file_put_contents($dir."/info.txt",serialize($array));
		return $return;
	}
	public function not_sale_exit($url)
	{
		$data = Sale::find()->where(['url'=>$url])->one();
		return (empty($data)) ? true : false;
	}
	public function get_curl_url($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$content = curl_exec($ch);
		$url=preg_replace("/.*Location:(.*?)\n.*/is","\$1",$content);
		$url=preg_replace("/\?frm=bdzhixin.*/is","",$url);
		$url=preg_replace("/\?utm_source.*/is","",$url);
		$url=preg_replace("/\&utm_source.*/is","",$url);
		$url=preg_replace("/\?tracker_u.*/is","",$url);
		$url=preg_replace("/\?_ddclickunion.*/is","",$url);
		if(strpos($url,"xiu.com"))
		$url=preg_replace("/\?from=.*/is","",$url);
		return trim($url);
	}
	/**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCreate() {
		$model = new Sale();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$arr = array('errno' => "0", 'error' => "添加成功！", 'url' => Url::toRoute(['sale/index']));
			echo json_encode($arr);
			die();
			//return $this->redirect(['view', 'id' => $model->id]);
		} else {
			if(Yii::$app->request->post())
			{
				$arr = array('errno' => "1", 'error' => "添加错误！", 'url' => '');
				echo json_encode($arr);
				die();
			}
			return $this->render('create', [
			'model' => $model,
			'category_list_site' => Sale::getCategoryListSite(),
			'category_list_category' => Sale::getCategoryListCategory(),
			'category_list_brand' => Sale::getCategoryListBrand(),
			'CsrfToken' => Yii::$app->getRequest()->getCsrfToken(),
			]);
		}
	}
	/**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			//return $this->redirect(['view', 'id' => $model->id]);
			$arr = array('errno' => "0", 'error' => "编辑成功！", 'url' => Url::toRoute(['sale/index']));
			echo json_encode($arr);
			die();
		} else {
			return $this->render('update', [
			'model' => $model,
			'category_list_site' => Sale::getCategoryListSite(),
			'category_list_category' => Sale::getCategoryListCategory(),
			'category_list_brand' => Sale::getCategoryListBrand(),
			'CsrfToken' => Yii::$app->getRequest()->getCsrfToken(),
			]);
		}
	}
	public function actionAjaxSaleShow() {
		$sale = Sale::find()->orderBy("id desc")->limit(1)->one();
		$sale_site=SaleSite::find()->where(['id'=>$sale->site])->one();
		$array=array("sale_title"=>$sale->title,"sale_id"=>$sale->id,"site"=>$sale_site->name);
		echo json_encode($array);
		die();
	}
	public function actionAjaxSaveIsShow() {
		//var_dump(Yii::$app->request->post());
		$id = Yii::$app->request->post("id");
		$model = $this->findModel($id);
		$is_show = $model->is_show;
		$is_show = ($is_show == 1) ? 2 : 1;
		$model->is_show =$is_show;
		$model->save();
		echo $is_show;
		die();
	}
	public function actionAjaxSaveSortOrder() {
		//var_dump(Yii::$app->request->post());
		$id = Yii::$app->request->post("id");
		$sort_order= Yii::$app->request->post("orderby");
		$model = $this->findModel($id);
		$model->sort_order =$sort_order;
		$model->save();
		echo $sort_order;
		die();
	}
	/**
     * Deletes an existing Sale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	public function actionDelete($id) {
		$model=$this->findModel($id);
		@unlink("../../../".Yii::getAlias("@base_url")."/".$model->pic);
		$model->delete();
		return $this->redirect(['index']);
	}
	public function actionDeleteall() {
		$id = Yii::$app->request->post("id");
		if(!empty($id))
		{
			if(preg_match("/^\d+$/is",$id))
			{
				$model=$this->findModel($id);
				@unlink("../../../".Yii::getAlias("@base_url")."/".$model->pic);
				$model->delete();
			}
			elseif(strpos($id,";")!==false)
			{
				$id_s=explode(";",$id);
				$id_array=array();
				foreach($id_s as $val)
				{
					if(preg_match("/^\d+$/is",$val))
					array_push($id_array,$val);
				}
				if(!empty($id_array))
				{
					$str="";
					foreach($id_array as $ids)
					{
						$model=$this->findModel($ids);
						@unlink("../../../".Yii::getAlias("@base_url")."/".$model->pic);
						$model->delete();
					}
					//Sale::deleteAll(array('in', 'id',$id_array));
				}
			}
		}
		die();
	}
	/**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	protected function findModel($id) {
		if (($model = Sale::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
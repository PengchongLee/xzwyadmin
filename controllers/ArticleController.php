<?php 
namespace app\controllers;
use app\common\components\BaseController;
use app\models\XzwyContent;
use app\models\XzwyImg;
use app\models\XzwyNav;

class ArticleController extends BaseController
{
  	
	public function actionAdd()
	{	

		if( $this->post() )
		{	
			$nav_info = XzwyNav::find()->all();
			
			return $this->render( 'add', ['nav_info'=>$nav_info]);
		}
		else
		{
			$nav_id 	= intval( $this->post( 'nav_id' ,'' ) );
			$title 		= trim( $this->post( 'title' ,'' ) );
			$summary 	= trim( $this->post( 'summary' ,'' ) );
			$nav_id 	= trim( $this->post( 'nav_id' ,'' ) );
			$imagekey 	= trim( $this->post( 'imagekey' ,'' ) );

			$time 		= date( 'Y-m-d  H:i:s' ); 

			$article = new XzwyContent();

			$article->content_title = $title;
			$article->content_info = $summary;
			$article->create_time = $time;
			$article->update_time = $time;
			$article->nav_id = $nav_id;

			$article->save( 0 ); 

			$id =  $article->attributes['content_id'] ;

			if( !empty( $id ) && isset( $id )  )
			{
			
				$imagearr = explode(',',$imagekey);
				foreach( $imagearr as $val )
				{	
					$image = new XzwyImg();
					$image->img_path = $val;
					$image->xzwy_content_content_id = $id;
					$image->save();
				}
			}

			return  $this->renderJson( [],'添加成功', 200 );
		}
	}


	public function actionShow()
	{
		if( $this->isRequestMethod( 'get' ) )
		{	
			$nav_id = trim( $this->get('cid', '') );
			$keywords = trim( $this->get('keywords', '') );
			$page   = intval( $this->get( 'page' ,1 ) );

			$query = XzwyContent::find()->joinWith( ['xzwy_nav'] )->joinWith( ['xzwy_img'] );

			if( is_numeric( $nav_id )  && !empty( $nav_id )  )
			{
				$query->andWhere( [ '`xzwy_content`.`nav_id`'=>$nav_id ] );
			}

			if( !empty( $keywords ) )
			{	
				$query->andWhere( ['LIKE', '`xzwy_content`.`content_title`', "%".$keywords."%", false ] );
			}	

			$page_num = 3;
			$total_count = $query->count();
            $total_page  = ceil( $total_count / $page_num );

			$article_info = $query->orderBy( ['create_time'=> SORT_DESC ] )
						  ->offset( ($page-1)*$page_num )
                          ->limit( $page_num )
                          ->asArray()
                          ->all();
// var_dump($article_info);die;
			$nav_info = XzwyNav::find()->all();

			return $this->render( 'show', ['nav_info'=>$nav_info, 
				'article_info'=>$article_info,
				'pages'=>[
                            'page'		 =>	$page,
                            'total_count'=>	$total_count,
                            'total_page' =>	$total_page,
                            'page_num'   =>	$page_num,
                           ],
				 ]);
		}
		
	}

	public function actionOps()
	{
		$id =  $this->post('id', '') ;
		$ops =  $this->post('ops', '') ;

		if( !empty( $ops ) )
		{	
			$id = explode(',', $id);
			$res = XzwyImg::deleteAll(  ['in', 'xzwy_content_content_id', $id] );

			if( $res >0 )
			{
				$info  = XzwyContent::deleteAll(   ['in', 'content_id', $id] );
			}
		}
		else
		{
			$res = 	XzwyImg::deleteAll( ['xzwy_content_content_id'=>$id] );

			if( $res >0 )
			{
				$info  = XzwyContent::deleteAll( ['content_id'=> $id ] );
			}
		}
		

		return  $this->renderJson( [],'删除成功', 200 );

	}


	



}


 ?>
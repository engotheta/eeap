<?php namespace App\Traits;

use Illuminate\Support\Collection as Collection;
use Config;
use Elasticsearch;

trait ElasticSearchTrait {

	public static function bootElasticSearchTrait(){
		if(!env('ELASTICSEARCH_ON')){
			return;
		}

		static::created(function($item){
			$item->createIndex();
		});		
		static::updated(function($item){
			$item->createIndex();
		});		
		static::deleted(function($item){
			$item->deleteDocument();
		});
	}

	public function getIndex()
	{
		return $this->getTable();
	}

	public function getType()
	{
		return $this->getTable();
	}

	public function getId()
	{
		return $this->id;
	}

	public function getBody()
	{

		$info =  $this->toArray();
		$fields =  array_only($info,$this->indexable);

		$generateShowUrl = true;
		//unique field used to generate url to resource
		$uniqueField=$this->{$this->primaryKey};
		$url=$this->getType();
		if(!is_null($this->urlPrefix)){
			$url=$this->urlPrefix;
			
		}
		if(!is_null($this->urlUniqueField)){

			$url_field = $this->urlUniqueField;
			//if returned field is array
			if(is_array($url_field)){

				$key = key($url_field);
					$url =  ($url_field[$key]['generateURL'])?$url:'';
					$fields['url_en'] =$url;
					$fields['url_sw'] =$url;
				
				if(/*$url_field[$key]['showUrl'] &&*/ !$url_field[$key]['translate']){
					$fields['url_en'] =$url.'/'.$fields[$key];
					$fields['url_sw'] =$url.'/'.$fields[$key];
				}
				if($url_field[$key]['translate']){
					$fields['url_en'] =$url.'/'.$fields[$key.'_en'];
					$fields['url_sw'] =$url.'/'.$fields[$key.'_sw'];
				}
			}
			else {

				die('malformed urlUniqueField');

			}

		}

		else {

			$fields['url_en']=$url;
			$fields['url_sw']=$url;
		}



		foreach($fields as &$field){
			$field = strip_tags($field);
		}
		return $fields;
	}	

	public function createIndex()
	{
		$data =$this->getIndexableData();
	;

		try{
				$client = new Elasticsearch\Client();

                 $attachments = [];
                   $fields_only = [];
                   foreach(Config::get('es')['attachments'] as $lang){
                   		foreach ($lang as $key => $value) {
                   			$fields_only[]=$value;
                   			$attachments[$value]=[
				                        "type" => "attachment",
				                  		"fields" => [
					                    	"content" => ["type"=>"string","store" => true,"term_vector"=>"with_positions_offsets"]
	                					]
	                					];

                   		}
                   }





				if(!$client->indices()->exists(['index'=>$data['index']])){
					 $params=[];
					 $params['index']=$data['index'];
		 

			            $params['body']['mappings']=[
						"_default_" => [
			            "_all"=>["enabled"=>true,'store'=>true],

			                "properties" => [

			                    "url_en" => [
			                        "type" => "string",
			                        "index" => "no"
			                    ],			                    
			                    "url_en" => [
			                        "type" => "string",
			                        "index" => "no"
			                    ],

			/*                    "doc_link_en" => [
			                        "type" => "attachment",
			                        "fields" => [
				                    "content" => ["type"=>"string","store" => true,"term_vector"=>"with_positions_offsets"]
                					]
			                    ],
			                    "doc_link_sw" => [
			                        "type" => "attachment",
			                  		"fields" => [
				                    "content" => ["type"=>"string","store" => true,"term_vector"=>"with_positions_offsets"]
                					]
			                    ]*/
			                ]

			            ]
			            ];

  
	            $params['body']['mappings']['_default_']['properties']+=$attachments;



			 		$client->indices()->create($params);
				}
						$docs = array_only($data['body'],$fields_only);

						foreach ($docs 	as $key => $value) {
							$path  =  public_path().'/'.$value;
							$content = file_get_contents($path);
							$data['body'][$key]=base64_encode($content);
						}



				 $client->index($data);
			}
			catch(Exception $e){
					//die($e->getMessage());
			}

		return true;
	}	

	public function deleteDocument()
	{
		try{

			$client = new Elasticsearch\Client();
			$client->delete(array_only($this->getIndexableData(),['id','type','index']));
		}
		catch(Exception $e){

		}
	}

	public function getIndexableData(){
	 	//return indexable data
	 	return array(

				'index' => Config::get('es')['index'],
				'type'	=> $this->getType(),
				'id'	=> $this->getId(),
				'body'	=> $this->getBody()

				);		
	}

	public function searching($term,$currentPage=null){
		
		try{
			//connection with elastic search
			$client = new Elasticsearch\Client();
			
			if(!$client->indices()->exists(['index'=>Config::get('es')['index']])){
				App::abort(404);
			}

			$criteria =[];
			//set page items hapa (variable)
			//pagination
			$criteria['size']=$this->options['pageSize']; //how many records per page
			$page = (!is_null($currentPage)) ? $currentPage-1 : 0; //if no page was requested deliberately then page one is displayed by default

			//remember to sanitize page
			$criteria['from'] = $page;

			$criteria['query']['query_string']['query']='*'.$term.'*'; //using wildcard before text is not advised because of perfomance. Either way we use it because it does not use more stor
			$params['index'] = Config::get('es')['index'];
			$criteria['query']['query_string']['fields']=[];

			//pick and choose fields to highlight by default all fields
			// $criteria['highlight']['fields']=["body_sw"=>["fragment_size" => 150, "number_of_fragments" => 3],"body_en"=>["fragment_size" => 150, "number_of_fragments" => 3]]; //specific fields highlighting
			// $criteria['highlight']['fields']=["*"=>["fragment_size" => 150, "number_of_fragments" => 3]];
			$criteria['highlight']['fields']=["_all"=>["fragment_size" => 150, "number_of_fragments" => 3]];


			
			$params['body']  = $criteria;
			//dealing with response
			$response = $client->search($params);


			$response['hits']['hits']['data'] =  $response['hits']['hits'];

			$response['hits']['hits']['stats']['records'] =  $response['hits']['total'];
			$response['hits']['hits']['stats']['pageSize'] = (isset($this->options['pageSize']))?$this->options['pageSize']:Config::get('es')['pageSize'];
			$response['hits']['hits']['stats']['currentPage']=$criteria['from']+1;

			return Collection::make($response['hits']['hits']);
		}
		catch(Exception $e){

		}
	
	}

}






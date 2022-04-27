<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
function linkx($text){
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}


$route['default_controller'] 	= 'main';
$route['404_override'] 			= 'main/error_404';
$route['translate_uri_dashes'] 	= FALSE;
#halaman
$route['about-us']				= 'main/about_us';
$route['api-capabilities'] 		= 'main/api_capabilities';
$route['contact-us'] 			= 'main/contact_us';
$route['faq'] 					= 'main/faq';
$route['blog'] 					= 'main/blog';
$route['news-and-events'] 		= 'main/news_event';
$route['product-and-pricing'] 	= 'main/product_pricing';
$route['products-and-pricing'] 	= 'main/product_pricing';
$route['business-solutions'] 	= 'main/business_solutions';
$route['corporate-business-risk'] 	= 'main/corporate_business_risk';
$route['corporate-due-diligence'] 	= 'main/corporate_due_diligence';
$route['know-your-customer'] 	= 'main/know_your_customer';
$route['corporate-linkages'] 	= 'main/corporate_linkages';
$route['strategic-marketing-lead-generation'] 	= 'main/strategic_marketing_lead_generation';
$route['customised-data'] 		= 'main/customised_data';
$route['company-database-and-data-enhancement'] 	= 'main/company_database_and_data_enhancement';
$route['information-monitoring'] 	= 'main/information_monitoring';

$route['traders-importers-exporters']   = 'main/traders_importers_exporters';
$route['industry-served'] 	            = 'main/traders_importers_exporters';
$route['financial-service-providers'] 	= 'main/financial_service_providers';
$route['government'] 					     = 'main/government';
$route['law-and-accounting-firms'] = 'main/law_and_accounting_firms';
$route['privacy-policy'] 				   = 'main/privacy_policy';
$route['refund-policy'] 				   = 'main/refund_policy';
$route['terms-of-service'] 				 = 'main/terms_of_service';


include( BASEPATH .'database/DB.php' );
$db =& DB();
$query 	= $db->get('UT_Menu');
$result = $query->result();
foreach($result as $row ):
    $route[$row->Url]    = $row->Root;
endforeach;

$db->where("Active", 1);
$db->where("Language", 1);
$query_article = $db->get("Article");
foreach ($query_article->result() as $v) {
  $link = strtolower($v->Name);
  $link = str_replace(' ', '-', $link);
  $link = rtrim($link,"/");
  $route[$link] = 'main/article_detail/'.$link;
}

$db->select("ContentID,Name,Link");
$db->where("Type","Page");
$query = $db->get("Content");
$result = $query->result();
foreach($result as $a):
  $Link         = $a->Link;
	$route[$Link] 	= "main/content_detail/".$Link; 
endforeach;
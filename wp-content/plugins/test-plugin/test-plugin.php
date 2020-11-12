<?php
/*
 Plugin Name: FinancialModelingPrep
 Plugin URI: http://mystore.com
 Description: Retrieve Stock Info such as stock symbol, logo and company information.
 Author: Hari Annam
 Version: 1.0
 Text Domain: financialModeling
 Domain Path: /languages
 License: GPL v2 or later
 License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 */
 // Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// function get_data($atts) {
// 	$name = $atts['name'];
//      $response = wp_remote_get ( 'https://financialmodelingprep.com/api/v3/quote/' . $name .'?apikey='. API_KEY, array ( 'sslverify' => false ) );
//     if ( !is_wp_error ($response) ) {
//         $body =  wp_remote_retrieve_body($response);
//         $data = json_decode( $body );
//         //print_r( $data);
//         return '<ul>
// 	        <li><span>Exchange:</span>' .  $data[0]->exchange . '</li>
// 	        <li><span>Price Change:</span>' . $data[0]->change . '</li>
//         </ul>';
        
//     }
// }

// add_shortcode('getdata', 'get_data');

if(!class_exists('Stock_Data')){ //check if the class already exists
class Stock_Data {

    protected $apiUrl = 'https://financialmodelingprep.com/api/v3/';
    /**
     * Instance of this class.
     *
     * @var      Stock_Data
     */
    private static $instance;
 
    /**
     * Initializes the plugin so that the we get the required information.
     * Note that this constructor relies on the Singleton Pattern
     *
     * @access private
     */
    private function __construct() {
        add_shortcode('getdata', array($this, 'display_data_information'));
        add_shortcode('symbol', array($this, 'display_symbol_information'));
        add_shortcode('profile', array($this, 'display_profile_information'));
        add_shortcode('company', array($this, 'display_company_information'));
    } // end constructor
 
    /**
     * Creates an instance of this class
     *
     * @access public
     * @return Stock_Data   An instance of this class
     */
    public function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    } // end get_instance
 
    /**
     * Displays the company information wherever the short code is used.
     *
     * @access public
     * @param  $content    
     * @return $content    
     */

    //this function makes two api calls since we cannot get all the required from one
    public function display_company_information($content ) 
    {
       
        // FIRST CALL

        if ( null == ( $json_response = $this->make_data_request($content, 'quote/') ) || null == ( $json_response_two = $this->make_data_request($content, 'profile/') ) ){
                // ...display a message that the request failed
                
                 $html = 'There was a problem communicating with the Financial Data API..';
                 
                 
                // ...otherwise, read the information provided by API
            } 
           
            else{
                $arrayOne = json_decode(json_encode($json_response), true);
                $arrayTwo = json_decode(json_encode($json_response_two), true);
                $result = array();
                foreach($arrayOne as $key=>$val){ // Loop though one array
                    $val2 = $arrayTwo[$key]; // Get the values from the other array
                    $result[$key] = $val + $val2; // combine 'em
                }

                $html = '<table border = "1">
                            <tr>
                            <th>Exchange</th>
                            <th>Price Change</th>
                            <th>Price Change Percentage</th>
                            <th>52 week range</th>
                            <th>Beta</th>
                            <th>Volume Average</th>
                            <th>Market Capitalisation</th>
                            <th>Last Dividend</th>
                            </tr>
                            <tr>
                            <td>'.$result[0]['price'].'</td>
                            <td>'.$result[0]['change'].'</td>
                            <td>'.$result[0]['changesPercentage'].'</td>
                            <td>'.$result[0]['range'].'</td>
                            <td>'.$result[0]['beta'].'</td>
                            <td>'.$result[0]['avgVolume'].'</td>
                            <td>'.$result[0]['marketCap'].'</td>
                            <td>'.$result[0]['lastDiv'].'</td>
                            </tr>
                        </table>';        
                 
            }

            return $html;
            
    }
    public function display_data_information( $content ) {
        
            
            if ( null == ( $json_response = $this->make_data_request($content) ) ) {
 
                // ...display a message that the request failed
                $html = '
				<div id="demo-content">';
				 $html .= 'There was a problem communicating with the Financial Data API..';
				 $html .= '</div>
				<!-- /#demo-content -->';
				 
                // ...otherwise, read the information provided by API
            } else {
 
                $html = '<ul>
					        <li><span>Exchange:</span>' .  $json_response[0]->exchange . '</li>
					        <li><span>Price Change:</span>' . $json_response[0]->change . '</li>
					        <li><span>Price Change:</span>' . $json_response[0]->previousClose . '</li>
				        </ul>';
 
            } // end if/else
 
            
 
 
        return $html;
 
    } // end display_data_information

    public function display_symbol_information( $content ) {
        
            // ...attempt to make a response to API
            if ( null == ( $json_response = $this->make_data_request($content, 'quote/') ) ) {
 
                // ...display a message that the request failed
                $html = '
                <div id="demo-content">';
                 $html .= 'There was a problem communicating with the Financial Data API and displaying Symbol information..';
                 $html .= '</div>
                <!-- /#demo-content -->';
                 
                // ...otherwise, read the information provided by API
            } else {
                
                $html = '
                           ( ' .  $json_response[0]->exchange . ' : ' . $json_response[0]->symbol .')
                            
                        ';
                 $html .= '</div> <!-- /#demo-content -->';
 
            } // end if/else
 
            
 
 
        return $html;
 
    } // end display_symbol_information

    //this gets the company profile
    public function display_profile_information( $content ) {
        
            // ...attempt to make a response to API
            if ( null == ( $json_response = $this->make_data_request($content, 'profile/') ) ) {
 
                // ...display a message that the request failed
                $html = '
                <div id="demo-content">';
                 $html .= 'Unable to retrieve the required information..';
                 $html .= '</div>
                <!-- /#demo-content -->';
                 
                // ...otherwise, read the information provided by API
            } else {
                
                $html = '
                           <img src=" ' .  $json_response[0]->image . ' "/> <br/>' .  $json_response[0]->companyName .' <br/>' .  $json_response[0]->exchange .'<br/>' .  $json_response[0]->description .'<br/>' .  $json_response[0]->industry .'<br/>' .  $json_response[0]->sector .'<br/>' .  $json_response[0]->ceo .'<br/>' .  $json_response[0]->website .'
                            
                        ';
                 $html .= '</div> <!-- /#demo-content -->';
 
            } // end if/else
 
            
 
 
        return $html;
 
    } // end display_symbol_information
 
    /**
     * Attempts to request the specified data from Financialmodelingprep
     *
     * @access public
     * @param  $atts  The username for the  feed we're attempting to retrieve
     * @return $quote  endpoint of the API
     */
    public function make_data_request( $atts, $quote ) {
    	$name = strtoupper($atts['name']);
     	$response = wp_remote_get ( $this->apiUrl .$quote . $name .'?apikey='. API_KEY, array ( 'sslverify' => false ) );
	    if (!is_wp_error ($response) ) {
	        $body =  wp_remote_retrieve_body($response);
	        $data = json_decode( $body );
	        //print_r( $data);
	        return $data;
	        
	    }
	    else{
	    	return null;
	    }
 
    } // end make_data_request
 
 
} // end class
 
// Trigger the plugin
Stock_Data::get_instance();
}
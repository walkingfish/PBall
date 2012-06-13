<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    
    <style type="text/css">
	section {
		border: 3px solid #ccc;
		width: 80%;
		padding: 5px;
		margin: 10px;
	}
        #finalresult {
            font-size: 2.6em;
            line-height: 2.6em;
        }
        #finalresult p {
            display: block;
            height: 1.2em;
            text-align: center;
            padding: 0;
            margin: 0;
        }
        #finalresult span {
       
        }
        #PBall {
            color: red;
        }
        .detected {
            color: blue;
        }
        em {
            color: green;
        }
        .quickpick {
            display: block;
            font-size: 2em;
            text-align: center;
            line-height: 2.2em;
            border: 1px solid #ccc;
        }
        .quickpick a, .quickpick a:link, 
        .quickpick a:hover, .quickpick a:visited,
        .quickpick a:active {
            text-decoration: none;
            color: black;
            text-transform: uppercase;
        }
    </style>
    
    <?php
	
        //return a random number from 1 - 59
        function fn_onetofiftynine() {
            return rand(1, 59);
        }
        
        //return a random number from 1 - 35
        function fn_onetothirtyfive() {
            return rand(1, 35);
        }
        
       
	
	//compares two numbers. if they are equal, then pick a new one until they are different
        //and returns the new one
        function fn_compare($a, $b) {
            if ($a == $b) {
                $b = fn_onetofiftynine();
                return fn_compare($a, $b);
            } else {
                return $b;
            }
        }	
	
	
	
    ?>
    
    
    
    <body>
    <p>This is a simulation to generate an array of random numbers. Randomly selected number is compared with contents in the array, so no repeated number will be pushed.</p>
    <p>Good luck to you, and hope you can really win from the final result.</p>

<section>
<h1>PBall</h1>
<p>To simulate Florida Power Ball.</p>
<p>Five numbers will be selected from 1 to 59 randomly, and PBall number will be randomly picked from 1 to 35. Here we go!</p>
<?php

	$aryNumbers = array(); // new array to store random numbers
	$numbers = 5; //5 numbers will be generated
        $tempnumber = 0; //a temporary holder for a newly generated number
	
        //pick 5 numbers and push to an array
	do {
            if (empty($aryNumbers)) { //if array is empty, 1st random number is pushed into array
                $tempnumber = fn_onetofiftynine(); //pick a random number and assign it to temp holder
                array_push($aryNumbers, $tempnumber); //push the temp number into array
                echo '<p>Array is empty!</p>';
                echo '<p><em>1st number is pushed: ' . $tempnumber . '</em><p>';
                echo '<p>--------------------------</p>';
            } else {
                
                /*
                 * checking temp number with numbers in array so no repeated numbers will be 
                 * pushed into the array
                 */
                
                //pick a random number and assign it to temp holder 
                $tempnumber = fn_onetofiftynine(); 
                echo '<p>temp# picked: ' . $tempnumber . '</p>';
                
                
                //check for array length
                $arraylength = count($aryNumbers);
                
                //compare temp number with array contents and push the temp number into the array
                echo '<div>***** Compare + Push ******';
                for ($key=0; $key<$arraylength; $key++) {
                    
                    echo '<p>temp# compares with array['.$key.']: ' . $aryNumbers[$key] . '</p>';
                    
                    if ($tempnumber == $aryNumbers[$key]) {
                        //when same number detected, temp number gets a new number and reset array 
                        //index back to 0 to compare again
                        $tempnumber = fn_compare($aryNumbers[$key], $tempnumber);
                        $key = -1;
                        echo '<div class="detected">';
                        echo '<p>SAME NUMBERS DETECTED! temp# is changed to: ' . $tempnumber . '</p>';
                        echo '<p>C+P restarts.</p>';
                        echo '</div>';
                    } else {
                        //temp number stays the same
                        echo '<p>temp# is still: ' . $tempnumber . '</p>';
                    } 
                }
                
                array_push($aryNumbers, $tempnumber);
                echo '<p><em>temp# is pushed: '.$tempnumber.'</em></p>';
                echo '**************</div>';
                
                echo '<p>';
                //display array contents
		foreach($aryNumbers as $current) {
			echo ' ' . $current . ' ';
		}
                echo '</p>';
                echo '<p>--------------------------</p>';
                
                
                
                
                
                
            }
           
            $numbers--;
	} while ($numbers != 0);
        
        
        
        //Pick number from 1 to 35
        $tempnumber = fn_onetothirtyfive();
        echo 'PBall: ' . $tempnumber;
?>
   
</section>

<?php
    //check for the array 
    if (empty($aryNumbers)) {
            echo '<strong>The array is empty!</strong>'; //when array is empty
    } else {
            //sort the final result array then display array contents
            sort($aryNumbers);
            echo '<div id="finalresult"><p>Final Result</p>';
            echo '<p>';
            foreach($aryNumbers as $current) {
                    echo '<span class="regularball">' . $current . ' - </span>';
            }
            echo '<span id="PBall">' . $tempnumber . '</span></p>';
            echo '</div>';
    }
?>
<p class="quickpick"><a href="index.php">Quick Pick</a></p>
    </body>
</html>
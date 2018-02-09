<?php

class StateUtils {

	/*
	 * The function we'll call
	 *
	 * @return int
	 */
	public static function calculateTimeInState($statusLog, $startDate, $stopDate) {

  		// Implementation starts here
		
		defined('PAUSED') or define ("PAUSED", "PAUSED");		
		defined('RUNNING') or define ("RUNNING", "RUNNING");
		defined('COMPLETE') or define ("COMPLETE", "COMPLETE");
		
		//For which state?
		$requiredState = RUNNING;
		
		//Check if dates are passed
		$hasStartDate = ($startDate != null)? true: false;
		$hasStopDate = ($stopDate != null)? true: false;
		
		//Sort log based on date
		$name = 'date';
		usort($statusLog, function ($a, $b) use(&$name){
			return $a[$name] - $b[$name];});
				
		//Initialize to default values
		$stateStartTime = -1;
		$seconds = 0;
		
		for($i=0; $i<sizeof($statusLog,0); $i++)
		{	
			//Save the time if process begins in required state & make sure not to re-initialize for Old state and new state are same
			if(strcmp($statusLog[$i]['newState'], $requiredState)==0 && $stateStartTime==-1){
				$stateStartTime = $statusLog[$i]['date'];				
			}
			//Process goes to next state from requried state, Calculate the time spent on previous state. 
			//Make sure this is not stopping and continuing in same state, dont have to do anything for this case
			else if(strcmp($statusLog[$i]['oldState'], $requiredState)==0 && !strcmp($statusLog[$i]['newState'], $requiredState)==0)
			{
				//make sure startdate if available is considered
				if($hasStartDate && ($stateStartTime - $startDate <0) ){
						$stateStartTime = $startDate;					
				}
				//make sure stopdate if available is considered
				if($hasStopDate && $stopDate-$statusLog[$i]['date']<=0)
				{
					$seconds += $stopDate - $stateStartTime;	
					return $seconds;//Nothing to do with remaining status logs if we hit the end date
				}
				else
					$seconds += $statusLog[$i]['date'] - $stateStartTime;
				$stateStartTime=-1;
				
			}
			$stateEndTime = time();	
		}
		
		//Process is still executing, handle based on startdate and stop date
		if($stateStartTime !=-1)
		{
			if($hasStartDate && ($stateStartTime - $startDate <0) )
				$stateStartTime = $startDate;
			if($hasStopDate)
				$seconds += ($stopDate-$stateStartTime);
			else
				$seconds += (time()-$stateStartTime);
		}
		
		return $seconds;

	}
}

?>
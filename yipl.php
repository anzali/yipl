
<?php

	//Input Part
        $fa = fopen('awards.csv', 'r');
        $fct = fopen('contracts.csv', 'r');

         while (($input = fgetcsv($fa, 0, ",")) !== FALSE)
	 {
            $awards[]=$input;
         }
        while (($input = fgetcsv($fct, 0, ",")) !== FALSE) 
	{
               $contracts[]=$input;
        }


	
	//Process part : compare and merge

        for($x=0;$x< count($contracts);$x++)
        {
            if($x==0){
                unset($awards[0][0]);
	         $line[$x]=array_merge($contracts[0],$awards[0]); 
            }
            else{
                $look=0;
                for($y=0;$y <= count($awards);$y++)
                {
                    if($awards[$y][0] == $contracts[$x][0]){
                        unset($awards[$y][0]);
                        $line[$x]=array_merge($contracts[$x],$awards[$y]);
                        $look=1;
                    }           
                }
                if($look==0)
                    $line[$x]=$contracts[$x];
            }
        }
    
	// Saving part
        $fp = fopen('final.csv', 'w');

        foreach ($line as $fields) {
            fputcsv($fp, $fields);
        }
	
        fclose($fp);

	$sum = 0;
	foreach ($line as $field)
	{
		
		if($field[1]=="Current" && $field[12])
		{
		$sum = $sum+$field[12];
		}
	}
	echo "Total Amount of current contracts: ".$sum;
?>

<?php

$graph = '';

if( !$this->customId )
{
    include __DIR__ . '/../_partials/canvas2-container.php';
}

    $graph .= "
    <script>
    	var ctx = document.getElementById('$this->id');
    	var data = {
    	    labels: ["; foreach ($this->labels as $label) {
        $graph .= "'".$label."',";
    } $graph .= '],
    	    datasets: [
                ';
                $i = 0;
                foreach ($this->datasets as $el => $ds) {
                    $graph .= "
        	        {
    					fill: false,
        	            label: \"$el\",
        	            lineTension: 0.3,
                        ";
                    if ($this->colors and count($this->colors) > $i) {
                        $c = $this->colors[$i];
                    } else {
                        $c = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    }
                    $graph .= 'borderColor: "'.$c.'", backgroundColor: "'.$c.'",';
                    $graph .= 'data: [';
                    foreach ($ds['values'] as $dta) {
                        $graph .= $dta.',';
                    }
                    $graph .= '],
        	        },';
                    $i++;
                }
                $graph .= "
    	    ]
    	};

    	var myLineChart = new Chart(ctx, {
    		type: 'line',
    		data: data,
    		options: {
                responsive: "; $graph .= ($this->responsive or !$this->width) ? 'true' : 'false'; $graph .= ",
                maintainAspectRatio: false,
    			title: {
    	            display: true,
                    text: \"$this->title\",
    				fontSize: 20,
    	        }
    	    }
    	});
    </script>
";

return $graph;

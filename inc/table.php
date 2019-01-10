<?php

    function TablewithCrud($title = array() ){
        $titles  = '';
        foreach($title as $titlex):
            $titles .= '<th>'.$titlex.'</th>';
        endforeach;

       	

        $table = '<div class="table-responsive">
			        <table class="table table-bordered datatable" style="width:100%">
						<thead>
							<tr>
								'.$titles.'
							</tr>
                        </thead>
                        <tbody>																			

                        </tbody>
					</table>
                </div>';
        echo  $table;

    }    
?>
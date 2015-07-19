<?php 
class asset
{
	
	function load($asset_name)
	{
		return PUBLIC_FOLDER . $asset_name;
	}
}
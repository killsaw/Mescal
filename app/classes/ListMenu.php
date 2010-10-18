<?php

class ListMenu
{
	protected $items = array();
	protected $colMax = 10;
	
	public function setItems($items) {
		$this->items = $items;
	}
	
	public function setColumnMax($max) {
		$this->colMax = $max;
	}
	
	public function modifyItems()
	{
	
	}
	
	public function toString($active_name=false)
	{
		$html = '<table class="list_menu">';
		
		
		foreach($this->getArray() as $col) {
			$html .= '<td valign="top"><ul>';
			foreach($col as $item) {
				$active = '';
				if ($active_name !== false) {
					if ($active_name == $item) {
						$active = ' class="active_menu"';
					}
				}
				$html .= sprintf('<li><a href="?table=%s"%s>%s</a></li>', 
							$item, $active, $item);
			}
			$html .= '</ul></td>';
		}
		$html .= '</table>';
		return $html;
	}
	
	public function getArray()
	{
		$total_items = count($this->items);
		$columns = array();
		
		for($i=0, $x=0; $i < $total_items; $i++) {
			if (($i % $this->colMax) == 0) {
				$columns[++$x] = array();
			}
			$columns[$x][] = $this->items[$i];
		}
		return $columns;
	}
}

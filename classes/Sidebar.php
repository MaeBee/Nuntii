<?php
	class Sidebar
	{
		private $elements;
		
		public function __construct()
		{
		}
		
		public function Add($element)
		{
			$this->elements[] = $element;
		}
		
		public function SortHintsUp()
		{
			// Pulls all hints from the element list and puts them to the top of the list.
			$hints;
			$others;
			foreach ($this->elements as $i => $element) {
				if (get_class($element) == "SidebarHint") {
					$hints[] = $element;
				} else {
					$others[] = $element;
				}
				unset($this->elements[$i]);
			}
			$this->elements = array_merge($hints, $others);
			$this->elements = array_values($this->elements);
		}
		
		public function ToHTML()
		{
			$this->SortHintsUp();
			$html = "";
			foreach ($this->elements as $element) {
				$html .= $element->ToHTML() . "\r\n";
			}
			return $html;
		}
	}
?>
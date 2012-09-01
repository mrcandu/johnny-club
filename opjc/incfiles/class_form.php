<?php
class form {
	
	public $name,$id,$method,$target;
	protected $output,$no_output;

	function __construct($no_output = null)
    {
        $this->no_output = $no_output;
    }
	
	function formSelect($name = '', $options = array(), $selected=null, $label=null,$mand=null,$no_blank=null,$class=0) {
	if($class==1){$class_in = ' class= "instyle";';}
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
    $html .= '<span class="instyle_s"><select id="'.$name.'" name="'.$name.'"'.$class_in.'>'."\r\n";
	if($no_blank==null){$html .= "".'<option value=""></option>'."\r\n";}
	if(!empty($options))
	{
		if (count($options) != count($options, COUNT_RECURSIVE)) {
			
			$options2 = $options;
			
			foreach ($options2 as $group => $options) {			
			foreach ($options as $key => $value) {
		
			$i++;
			$ii = $i-1;
			$grpchk[$i] = $group;
			
			if(isset($grpchk[$ii]) and $grpchk[$ii]!= $grpchk[$i]){
			$html .= "".'</optgroup>';
			}
			
			if(!isset($grp[$group])){
			$grp[$group]++;
			$html .= "".'<optgroup label="'.$group.'">';
			}
			
			if($key==$selected){$html_selected=" selected";}else{$html_selected="";}
        	$html .= "".'<option value="'.$key.'"'.$html_selected.'>'.$value.'</option>';
    		
			}
			$html .= "".'</optgroup>';	
			}
		}
		else {
   			foreach ($options as $key => $value) {
			if($key==$selected){$html_selected=" selected";}else{$html_selected="";}
        	$html .= "".'<option value="'.$key.'"'.$html_selected.'>'.$value.'</option>';
    		}
		}
	}
    $html .= '</select></span>'."\r\n";
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
	
	function formCheck($name = '', $value, $label=null,$mand=null) {
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	if($value=="1"){$html_checked=" checked";}else{$html_checked="";}
	$html .= '<input name="'.$name.'" type="checkbox" value="1"'.$html_checked.' class="chk" />';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
	
	function formRadio($name = '', $value, $label=null,$mand=null,$checked) {
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	if($checked=="1"){$html_checked=" checked";}else{$html_checked="";}
	$html .= '<input name="'.$name.'" type="radio" class="radio" value="'.$value.'"'.$html_checked.' />';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}	
	
	function formInput($name,$value,$label=null,$mand=null,$readonly=null,$class=1) {
	if($class==1){$class_in = ' class= "instyle"';}
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	if(isset($readonly)){$readonly=' readonly="readonly"';}
	$html .= '<input name="'.$name.'" id="'.$name.'" type="text"'.$class_in.' value="'.$value.'"'.$readonly.'>';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}

	function formPass($name,$value,$label=null,$mand=null,$readonly=null,$class=1) {
	if($class==1){$class_in = ' class= "instyle"';}
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	$html .= '<input name="'.$name.'" id="'.$name.'"'.$class_in.' type="password" value="'.$value.'" />';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
		
	function formHidden($name,$value) {
	$html .= '<input name="'.$name.'" id="'.$name.'" type="hidden" value="'.$value.'">';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}


	function formFile($name,$label=null,$mand=null) {
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	$html .= '<input name="'.$name.'" id="'.$name.'" type="file" />';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
	
	function formText($name,$value,$label=null,$mand=null) {
	if(isset($label)){$html = $this->formLabel($label,$name,$mand);}
	$html .= '<textarea name="'.$name.'" class= "instyle_t" id="'.$name.'">'.$value.'</textarea>';
	 	if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
	
	function formButton($name,$type,$value) {
	$html .= '<input name="'.$name.'" id="'.$name.'" type="'.$type.'" value="'.$value.'" class="btn" />';
		if($this->no_output == 1) {	
			return $html;
		}
		else {
			$this->output .= $html;
		}
	}
	
	function formLabel($label,$name,$mand=null) {
	if(!empty($mand)){$mand="<span class=\"mand\">**</span>";}
	$html = '<label for="'.$name.'">'.$mand.$label.'</label>'."\r\n";
	return($html);
	}
		
	function formRender() {
	$html = '<form name="'.$this->name.'" id="'.$this->id.'" method="'.$this->method.'" target="'.$this->target.'">';
	$html .= $this->output;
	$html .= '</form>'."\r\n";
	return $html;
	}
}
?>
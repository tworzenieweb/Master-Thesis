<?php

class myFormDecorator extends sfWidgetFormSchemaFormatter
{

    protected
            $rowFormat = '<div class="control-group">%hidden_fields% %label% <div class="controls">%field% %error% %help%</div> </div>',
            $errorRow = '<div class="control-group error">%hidden_fields% %label% <div class="controls">%field% <span class="help-inline">%error%</span> %help%</div> </div>',
            $errorListFormatInARow     = "%errors%",
            $errorRowFormatInARow      = "%error%<br />",
            $namedErrorRowFormatInARow = "%name%: %error%<br />";

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        
        
        return strtr(count($errors) ? $this->errorRow : $this->getRowFormat(), array(
                    '%label%' => $label,
                    '%field%' => $field,
                    '%error%' => $this->formatErrorsForRow($errors),
                    '%help%' => $this->formatHelp($help),
                    '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
                ));
    }

}
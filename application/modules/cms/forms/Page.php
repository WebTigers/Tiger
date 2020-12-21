<?php

class Cms_Form_Page extends Zend_Form {
    
    protected $_locale;
    protected $_translate;
    protected $_config;

    public function init() {
        
        $this->_locale          = Zend_Registry::get('Zend_Locale');
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_config          = Zend_Registry::get('Zend_Config');
        
        // Allows us to load and use custom ZendTiger validator classes with elements
        $this->addElementPrefixPath('Tiger_Validate', 'Tiger/Validate/', 'validate');
        $this->addElementPrefixPath('Tiger_Filter', 'Tiger/Filter/', 'filter');

        $this->setAction( '/ajax' )->
                setMethod('post')->
                setName('Cms_Form_Page')->
                setAttrib('id', 'page-form')->
                setAttrib('class', 'form-horizontal');

        $this->addElement($this->_getPageId());

        # URL Data #

        $this->addElement($this->_getKey());
        $this->addElement($this->_getCategory());
        $this->addElement($this->_getType());
        $this->addElement($this->_getName());

        # Article Content #

        $this->addElement($this->_getContent());
        $this->addElement($this->_getCreateDate());

        # CSS and JS #

        $this->addElement($this->_getCss());
        $this->addElement($this->_getJavascript());
        $this->addElement($this->_getStyles());
        $this->addElement($this->_getScripts());

        # SEO Data #

        $this->addElement($this->_getMetaTitle());
        $this->addElement($this->_getMetaDescription());

        # Open Graph Data #

        $this->addElement($this->_getOgTitle());
        $this->addElement($this->_getOgDescription());
        $this->addElement($this->_getOgUrl());
        $this->addElement($this->_getOgType());
        $this->addElement($this->_getOgLocale());

        $this->addElement($this->_getOgImage());
        $this->addElement($this->_getOgImageWidth());
        $this->addElement($this->_getOgImageHeight());
        $this->addElement($this->_getOgImageType());
        $this->addElement($this->_getOgImageAlt());

        $this->addElement($this->_getOgVideo());
        $this->addElement($this->_getOgVideoWidth());
        $this->addElement($this->_getOgVideoHeight());
        $this->addElement($this->_getOgVideoType());

        # Article Controls #

        $this->addElement($this->_getActive());
        $this->addElement($this->_getDeleted());


        # Global Decorator Declarations #
        $this->_setGlobalDecorators();

        # Now set some global filters, adjustments, and settings. #

        $this->_setGlobalFilters();
        $this->_elementAdjustments();
        
    }
    
    protected function _setGlobalDecorators ( ) {
        
        $this->clearDecorators();
        
        $this->addDecorators(array('FormElements', 'Form'));

        $this->setElementDecorators(array(
            array('ViewHelper'),
        ));
        
    }
    
    protected function _setGlobalFilters ( ) {
        
    }

    protected function _elementAdjustments ( ) {
        
    }
    
    // Form Fields //
    
    protected function _getPageId ( ) {

        $name = 'page_id';

        $options = array(
            'name'          =>  $name,
            'id'            =>  $name,

            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                ),
            'validators'    =>  array(
                                    array( 'Uuid', false ),
                            ),
        );
        
        return new Zend_Form_Element_Hidden( $name, $options );
        
    }

    protected function _getName ( ) {

        $name = 'name';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\- ]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\- ]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getKey ( ) {

        $name = 'key';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\-]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getCategory ( ) {

        $name = 'category';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\- ]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\- ]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getType ( ) {

        $name = 'type';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\-]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getContent ( ) {

        $name = 'content';

        $options = array(
            
            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                ),

            'value'         => 'Start typing here ... Select text to edit.',

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,
            
            'required'      =>  false,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array( 'PregReplace', array('match' => '/[^A-Za-z0-9\W\'\-,.!:\"\<\>\=\&\_\?\+\/]/', 'replace' => '') ),
                                ),
            'validators'    =>  array(
                                    // array( 'StringLength', false, array(1, 10000) ),
                                    array( 'Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\W\'\-,.!:\"\<\>\=\&\_\?\+\/]+$/',
                                        'messages' => array( Zend_Validate_Regex::NOT_MATCH => "Invalid characters." )
                                    )),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getCreateDate ( ) {

        $name = 'create_date';

        $options = array(
            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control',
            'attribs'       =>  array(
                'maxlength'     => 50,
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'disabled'      =>  true,
            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('Date', false, array( 'format' => 'yyyy-MM-dd' )),    // Uses Zend_Date not PHP date()
            ),
        );

        return new Zend_Form_Element_Text($name, $options);

    }

    protected function _getCss ( ) {

        $name = 'css';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s)]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters."))
                                    ),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getJavascript ( ) {

        $name = 'javascript';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
            ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getStyles ( ) {

        $name = 'styles';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
            ),
            'validators'    =>  array(
            ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getScripts ( ) {

        $name = 'scripts';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                ),
            'validators'    =>  array(
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getOgTitle ( ) {

        $name = 'og_title';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'placeholder' => $this->_translate->translate('form.article.label.' . $name),
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z 0-9\-]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z 0-9\-]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }
    
    protected function _getOgDescription ( ) {

        $name = 'og_description';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,
            
            'required'      =>  false,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9 \'\-\?\(\)\/\,."_!&%@#$]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 255)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9 \'\-\?\(\)\/\,."_!&%@#$]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );
        
    }
    
    protected function _getOgUrl ( ) {

        $name = 'og_url';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.article.label.' . $name),
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,
            
            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-\?_&=:.]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 255)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-\?_&=:.]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }
    
    protected function _getOgImage ( ) {

        $name = 'og_image';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.article.label.' . $name),
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-\?_&=:.]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 255)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-\?_&=:.]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }

    protected function _getOgImageWidth ( ) {

        $name = 'og_image_width';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^0-9]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 4)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[0-9]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }
    
    protected function _getOgImageHeight ( ) {

        $name = 'og_image_height';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^0-9]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 4)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[0-9]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }

    protected function _getOgImageType ( ) {

        $name = 'og_image_type';

        $typeList = [
            'image/png' => 'PNG',
            'image/jpeg' => 'JPG / JPEG',
            'image/gif' => 'GIF',
        ];

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control select2-offscreen',
            'attribs'       =>  array(
                                    'data-valid'            => '0',
                                ),

            'multiOptions'  =>  $typeList,

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^a-z\/]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 25)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[a-z\/]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Select( $name, $options );
        
    }

    protected function _getOgImageAlt ( ) {

        $name = 'og_image_alt';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'placeholder' => $this->_translate->translate('form.article.label.' . $name),
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,
            
            'required'      =>  false,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9 \'\-\?\(\)\/\,."!&%@#$]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9 \'\-\?\(\)\/\,."!&%@#$]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );
        
    }

    protected function _getOgVideo ( ) {

        $name = 'og_video';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
                'placeholder' => $this->_translate->translate('form.article.label.' . $name),
            ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('StringTrim'),
                array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-\?_&=:.]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 255)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\/\-\?_&=:.]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getOgVideoWidth ( ) {

        $name = 'og_video_width';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('StringTrim'),
                array('PregReplace', array('match' => '/[^0-9]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 4)),
                array('Regex', false, array(
                    'pattern' => '/^[0-9]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getOgVideoHeight ( ) {

        $name = 'og_video_height';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('StringTrim'),
                array('PregReplace', array('match' => '/[^0-9]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 4)),
                array('Regex', false, array(
                    'pattern' => '/^[0-9]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getOgVideoType ( ) {

        $name = 'og_video_type';

        $typeList = [
            'video/x-flv' => 'Flash .flv',
            'video/mp4' => 'MPEG-4 .mp4',
            'video/quicktime' => 'QuickTime .mov',
            'video/x-msvideo' => 'A/V Interleave .avi',
            'video/x-ms-wmv' => 'Windows Media .wmv',
        ];

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control select2-offscreen',
            'attribs'       =>  array(
                'data-valid'            => '0',
            ),

            'multiOptions'  =>  $typeList,

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('StringTrim'),
                array('PregReplace', array('match' => '/[^a-z0-9\/]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 25)),
                array('Regex', false, array(
                    'pattern' => '/^[a-z0-9\/]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getOgType ( ) {

        $name = 'og_type';

        $typeList = [
            'article' => 'Article',
            'video' => 'Video',
            'website' => 'Website',
        ];

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control select2-offscreen',
            'attribs'       =>  array(
                                    'data-valid'            => '0',
                                ),

            'multiOptions'  =>  $typeList,

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('StringTrim'),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-:.]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-:.]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Select( $name, $options );
        
    }

    protected function _getOgLocale ( ) {

        $name = 'og_locale';

        $typeList = [
            'en_US' => 'English US',
            'es_US' => 'Spanish US',
        ];

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control select2-offscreen',
            'attribs'       =>  array(
                                    'data-valid'            => '0',
                                ),

            'multiOptions'  =>  $typeList,

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'validators'    =>  array(
                                    array('Locale', false),
                                ),
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getMetaTitle ( ) {

        $name = 'meta_title';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.article.label.' . $name),
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z 0-9\-]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z 0-9\-]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getMetaDescription ( ) {

        $name = 'meta_description';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9 \'\-,.]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 255)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9 \'\-,.]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getActive ( ) {

        $name = 'active';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array( 'PregReplace', array( 'match' => '/[^0-1]/', 'replace' => '' ) ),
                                ),
            'validators'    =>  array(
                                    array( 'Between', false, array( 'min' => 0, 'max' => 1 ) ),
                                ),
        );

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    protected function _getDeleted ( ) {

        $name = 'deleted';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                ),

            'label'         =>  'form.article.label.' . $name,
            'description'   =>  'form.article.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array( 'PregReplace', array( 'match' => '/[^0-1]/', 'replace' => '' ) ),
                                ),
            'validators'    =>  array(
                                    array( 'Between', false, array( 'min' => 0, 'max' => 1 ) ),
                                ),
        );

        return new Zend_Form_Element_Hidden( $name, $options );

    }

}


<?php
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 03.11.2015
 * Time: 10:50
 */
class ConfigForm extends CFormModel{
    /** @var array Массив, содержащий в себе всю конфигурацию */
    private $_config = array();
    /** 	 * Инициализация модели
     * @param array $config Массив из конфига
     * @param string $scenario Сценарий валидации
     */
    public function __construct($config = array(), $scenario = '') 	{
        parent::__construct($scenario);
        $this->setConfig($config);
    }
    public function setConfig($config) 	{
        $this->_config = $config;
    }

    public function getConfig() {
        return $this->_config;
    }

    /** 	 * Возвращает все атрибуты с их значениями
     *  	 * @return array
     */
    public function getAttributes(){
        $this->attributesRecursive($this->_config, $output);
        return $output;
    }
    /**
     * Возвращает имена всех атрибутов
     *
     * @return array
     */
    public function attributeNames(){
        $this->attributesRecursive($this->_config, $output);
        return array_keys($output);
    }
    /**
     * Рекурсивно собирает атрибуты из конфига
     *
     * @param array $config
     * @param array $output
     * @param string $name
     */
    public function attributesRecursive($config, &$output = array(), $name = ''){
        foreach ($config as $key => $attribute) {
            if ($name == '')
                $paramName = $key;
            else
                $paramName = $name . "[{$key}]";
            if (is_array($attribute))
                $this->attributesRecursive($attribute, $output, $paramName);
            else
                $output[$paramName] = $attribute;
        }
    }
    public function attributeLabels()
    {
        return array(
            'name' => 'Название сайта',
            'params[adminEmail]' => 'Email администратора',
            'params[phoneNumber]' => 'Номер телефона',
            'params[motto]' => 'Девиз сайта',
        );
    }
    public function rules(){
        $rules = array();
        $attributes = array_keys($this->_config);
        $rules[] = array(implode(', ', $attributes), 'safe');
        return $rules;
    }
    public function __get($name){
    // Если атрибут есть в конфиге - возвращаем его. Если нет - передаём эстафетную палочку родительскому классу
    if (isset($this->_config[$name]))
        return $this->_config[$name];
    else
        return parent::__get($name);
    }
    public function __set($name, $value) 	{
    // Если атрибут есть в конфиге - пишем в него
    if (isset($this->_config[$name]))
        $this->_config[$name] = $value;
    else
        parent::__set($name, $value);
    }
    public function save($path) {
        $config = $this->generateConfigFile();
        // Предупредим программиста о том, что в файл не получится записать
        if(!is_writable($path))
            throw new CException("Cannot write to config file!");
        file_put_contents($path, $config, FILE_TEXT);
        return true;
    }
    public function generateConfigFile() 	{
        $this->generateConfigFileRecursive($this->_config, $output);
        $output = preg_replace('#,$\n#s', '', $output);
        // Регулярка делает красиво
        return "<?php\nreturn " . $output . ";\n";
    }
    public function generateConfigFileRecursive($attributes, &$output = "", $depth = 1) 	{
        $output .= "array(\n";
        foreach ($attributes as $attribute => $value) {
            if (!is_array($value))
                $output .= str_repeat("\t", $depth) . "'" . $this->escape($attribute) . "' => '" . $this->escape($value) . "',\n";
            else { 				$output .= str_repeat("\t", $depth) . "'" . $this->escape($attribute) . "' => ";
                $this->generateConfigFileRecursive($value, $output, $depth + 1);
            }
        }
        $output .= str_repeat("\t", $depth - 1) . "),\n";
        // Глубина нужна, чтобы определить длину отступа
        }
    private function escape($value) 	{
        /**
         * Это для того, чтобы с кавычкой не сломался синтаксис (php-injection).
         * Не исключаю, что в php есть какой-нибудь специальный метод,
         * зато я знаю, что ничего лишнего заэкранировано не будет
         */
        return str_replace("'", "\'", $value); 	}
}
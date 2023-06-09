<?php
/**
 * Created by PhpStorm
 * User: Serwinle
 * Date: 2023/4/14
 * Time: 14:34
 */

namespace Kzeal\SpecailCharTool\Dec;

use Kzeal\SpecailCharTool\InterfaceSpecailCharCheck;
use Kzeal\SpecailCharTool\Util\SpecailCharUtil;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;



class Check implements InterfaceSpecailCharCheck
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var string
     */
    private $str_rule;

    /**
     * @var array
     */
    private $arr_rule;

    /**
     * @var string
     */
    private $str_length;

    /**
     * @var string
     */
    private $str_length_init = 1;

    /**
     * @var string
     */
    private $config_prefix = 'specail_char_rule';

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $this->container->get(ConfigInterface::class);
        $this->loadConfig();
        $this->makeRule();
    }

    function setStractCheckConfig($rule_name = 'default')
    {
        $this->arr_rule = $this->config->get($this->config_prefix .'.'. $rule_name);
    }

    function setCheckLength()
    {
        $this->str_length = $this->config->get($this->config_prefix . '.check_num');
    }

    function makeRule()
    {
        foreach ($this->config->get($this->config_prefix . '.load_config') as $map) {
            $this->addRule($map);
        }
    }

    function addRule($rule_name = 'default')
    {
        $this->setStractCheckConfig($rule_name);
        if ($rule_name == 'default') {
            foreach ($this->arr_rule['rule'] as $key => $map) {
                if (empty($map)) {
                    continue;
                }
                if (SpecailCharUtil::isArrRule($key)) {
                    if (SpecailCharUtil::isSpecailRule($key)) {
                        $this->str_rule .= SpecailCharUtil::packDefaultArr($map);
                    } else {
                        $this->str_rule .= SpecailCharUtil::packNormalArrRule($map);
                    }
                } else {
                    if (SpecailCharUtil::isSpecailRule($key)) {
                        $this->str_rule .= SpecailCharUtil::packDefault($map);
                    } else {
                        $this->str_rule .= SpecailCharUtil::packNormalRule($map);
                    }
                }
            }
        } else {
            foreach ($this->arr_rule['rule'] as $key => $map) {
                if (empty($map)) {
                    continue;
                }
                if (SpecailCharUtil::isArrRule($key)) {
                    $this->str_rule .= SpecailCharUtil::packRuleArr($map);
                } else {
                    $this->str_rule .= SpecailCharUtil::packRule($map);
                }
            }
        }
    }

    function loadConfig($rule_name = 'default')
    {
        $this->setCheckLength();
    }

    function check($content)
    {
        $this->clean($content, $result);
        if (isset($result[0])) {
            $result = implode('', $result[0]);
            if (preg_match_all("/[{$this->str_rule}]{{$this->str_length},}/u", $result, $matches)) {
                return false;
            }
        }
        if (preg_match_all("/[{$this->str_rule}]{{$this->str_length},}/u", $content, $matches)) {
            return false;
        }
        if (preg_match_all("/[{$this->str_rule}]{{($this->str_length_init)},}/u", $content, $matches)) {
            $matches = count($matches[0]);
            if ($matches > $this->str_length) {
                return false;
            }
        }
        return true;
    }

    function clean($content, &$result)
    {
        preg_match_all("/[\x{4e00}-\x{9fa5}]/u",$content,$result);
    }


}
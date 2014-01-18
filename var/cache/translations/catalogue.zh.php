<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('zh', array (
  'errors' => 
  array (
    'admin_bundle.validator_errors.valid_server' => '服务器参数不正确',
    'admin_bundle.validator_errors.valid_player_ids' => '玩家 ID 列表参数不正确',
    'authentication.errors.bad_credentials' => '用户名或密码不正确',
  ),
  'messages' => 
  array (
    'simple_form.errors.required' => '此项为必填项',
    'simple_form.errors.email' => '请输入合法的 Email 地址',
    'simple_form.errors.url' => '请输入合法的 URL 地址',
    'simple_form.errors.valid_date' => '请输入合法的日期',
    'simple_form.errors.valid_date_time' => '请输入合法的日期时间',
    'simple_form.errors.date_iso' => '请输入合法的日期(ISO).',
    'simple_form.errors.number' => '请输入合法的数字',
    'simple_form.errors.digits' => '只能输入数字',
    'simple_form.errors.creditcard' => '请输入合法的信用卡卡号',
    'simple_form.errors.matches' => '请再次输入相同的值',
    'simple_form.errors.accept' => '请输入合法的值',
    'simple_form.errors.maxlength' => '最多能输入 {0} 个字符',
    'simple_form.errors.minlength' => '最少输入 {0} 个字符',
    'simple_form.errors.rangelength' => '只能输入 {0} ~ {1} 个字符',
    'simple_form.errors.range' => '请输入介于 {0} 和 {1} 的值',
    'simple_form.errors.max' => '最大不能超过 {0}',
    'simple_form.errors.min' => '最小不能小于 {0}.',
  ),
));


return $catalogue;

<?php

return [
    // 验证语言行
    // 以下语言行包含所使用的默认错误消息验证器类。
    // 其中的一些规则等多个版本随着大小的规则。随时调整这些消息。
    'accepted'             => '这个属性 :attribute 必须接受。',
    'active_url'           => '这个属性 :attribute 不是一个有效的URL。',
    'after'                => '这个属性 :attribute 必须是一个日期在这个时间 :date 之后。',
    'alpha'                => '这个属性 :attribute 只能包含字母。',
    'alpha_dash'           => '这个属性 :attribute 只能包含字母,数字和连字符。',
    'alpha_num'            => '这个属性 :attribute 只能包含字母和数字。',
    'array'                => '这个属性 :attribute 必须是一个数组。',
    'before'               => '这个属性 :attribute 必须是一个日期在这个时间 :date 之前。',
    'between'              => [
        'numeric' => '这个属性 :attribute 必须介于 :min 和 :max 之间。',
        'file'    => '这个属性 :attribute 必须介于 :min 和 :max 这么大字节之间。',
        'string'  => '这个属性 :attribute 必须介于 :min 和 :max 这么多字符之间。',
        'array'   => '这个属性 :attribute 必须介于 :min 和 :max 个节点之间。',
    ],
    'boolean'              => '这个属性 :attribute 字段必须是真或假。',
    'confirmed'            => '这个属性 :attribute 确认不匹配。',
    'date'                 => '这个属性 :attribute 不是一个有效的日期。',
    'date_format'          => '这个属性 :attribute 不匹配的格式 :format。',
    'different'            => '这个属性 :attribute 和 :other 必须是不同的。',
    'digits'               => '这个属性 :attribute 必须是 :digits 位数。',
    'digits_between'       => '这个属性 :attribute 必须是介于 :min 和 :max 位数。',
    'email'                => '这个属性 :attribute 必须是一个有效的电子邮件地址。',
    'exists'               => '这个选中的属性 :attribute 是无效的。',
    'filled'               => '这个属性 :attribute 字段是必需的。',
    'image'                => '这个属性 :attribute 必须是一个图象。',
    'in'                   => '这个选中的属性 :attribute 是无效的。',
    'integer'              => '这个属性 :attribute 必须是一个整数。',
    'ip'                   => '这个属性 :attribute 必须是一个有效的IP地址。',
    'json'                 => '这个属性 :attribute 必须是一个有效的JSON字符串。',
    'max'                  => [
        'numeric' => '这个属性 :attribute 不得大于 :max。',
        'file'    => '这个属性 :attribute 不得大于 :max 这么大字节。',
        'string'  => '这个属性 :attribute 不得大于 :max 这么多字符。',
        'array'   => '这个属性 :attribute 不能超过 :max 个节点。',
    ],
    'mimes'                => '这个属性 :attribute 必须是这些文件类型: :values。',
    'min'                  => [
        'numeric' => '这个属性 :attribute 必须至少 :min。',
        'file'    => '这个属性 :attribute 必须至少 :min 这么大字节。',
        'string'  => '这个属性 :attribute 必须至少 :min 这么多字符。',
        'array'   => '这个属性 :attribute 必须至少有 :min 个节点。',
    ],
    'not_in'               => '这个选中的属性 :attribute 是无效的。',
    'numeric'              => '这个属性 :attribute 必须是一个数字。',
    'regex'                => '这个属性 :attribute 格式是无效的。',
    'required'             => '这个属性 :attribute 字段是必需的。',
    'required_if'          => '这个属性 :attribute 字段是必需的 当 :other 是 :value。',
    'required_unless'      => '这个属性 :attribute 字段是必需的 除非 :other 是在 :values 里面。',
    'required_with'        => '这个属性 :attribute 字段是必需的 当 :values 是现在。',
    'required_with_all'    => '这个属性 :attribute 字段是必需的 当 :values 是现在。',
    'required_without'     => '这个属性 :attribute 字段是必需的 当 :values 不是现在。',
    'required_without_all' => '这个属性 :attribute 字段是必需的 当没有一个值 :values 是现在。',
    'same'                 => '这个属性 :attribute 和 :other 必须匹配。',
    'size'                 => [
        'numeric' => '这个属性 :attribute 必须是 :size 这么大。',
        'file'    => '这个属性 :attribute 必须是 :size 这么大字节。',
        'string'  => '这个属性 :attribute 必须是 :size 这么多字符。',
        'array'   => '这个属性 :attribute 必须包含 :size 个节点。',
    ],
    'string'               => '这个属性 :attribute 必须是一个字符串。',
    'timezone'             => '这个属性 :attribute 必须是一个有效的时区。',
    'unique'               => '这个属性 :attribute 已经存在.',
    'url'                  => '这个属性 :attribute 格式是无效的。',
    // 自定义验证语言行
    // 在这里你可以指定自定义验证消息属性使用公约”属性。规则”的名字。
    // 这使得它很快对于一个给定的属性指定一个特定的定制语言行规则。
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    // 自定义验证属性
    // 使用以下语言行交换属性的占位符等更读者友好的电子邮件地址“电子邮件”。
    // 这只是帮助我们使消息更清洁。
    'attributes' => [],

];

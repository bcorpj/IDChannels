<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят.',
    'accepted_if' => ':attribute должен быть принят, если :other равно :value.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должно быть датой после :date.',
    'after_or_equal' => ':attribute должно быть датой после или равной :date.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'ascii' => ':attribute может содержать только однобайтовые буквенно-цифровые символы и символы.',
    'before' => ':attribute должно быть датой до :date.',
    'before_or_equal' => ':attribute должно быть датой до или равной :date.',
    'between' => [
        'array' => ':attribute должно содержать от :min до :max элементов.',
        'file' => ':attribute должно быть от :min до :max килобайт.',
        'numeric' => ':attribute должно быть от :min до :max.',
        'string' => ':attribute должно содержать от :min до :max символов.',
    ],
    'boolean' => ':attribute должно быть true или false.',
    'can' => 'Значение :attribute не разрешено.',
    'confirmed' => ':attribute не совпадает с подтверждением.',
    'current_password' => 'Неправильный пароль.',
    'date' => ':attribute должно быть допустимой датой.',
    'date_equals' => ':attribute должно быть датой, равной :date.',
    'date_format' => ':attribute должно соответствовать формату :format.',
    'decimal' => ':attribute должно иметь :decimal десятичных знаков.',
    'declined' => ':attribute должно быть отклонено.',
    'declined_if' => ':attribute должно быть отклонено, если :other равно :value.',
    'different' => ':attribute и :other должны различаться.',
    'digits' => ':attribute должно быть :digits цифр.',
    'digits_between' => ':attribute должно быть от :min до :max цифр.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute имеет повторяющееся значение.',
    'doesnt_end_with' => ':attribute не должно заканчиваться на одно из следующих значений: :values.',
    'doesnt_start_with' => ':attribute не должно начинаться с одного из следующих значений: :values.',
    'email' => ':attribute должно быть допустимым адресом электронной почты.',
    'ends_with' => ':attribute должно заканчиваться одним из следующих значений: :values.',
    'enum' => 'Выбранное значение :attribute недопустимо.',
    'exists' => 'Выбранное значение :attribute недопустимо.',
    'file' => ':attribute должно быть файлом.',
    'filled' => 'Поле :attribute должно иметь значение.',
    'gt' => [
        'array' => ':attribute должно содержать больше :value элементов.',
        'file' => ':attribute должно быть больше :value килобайт.',
        'numeric' => ':attribute должно быть больше :value.',
        'string' => ':attribute должно содержать больше :value символов.',
    ],
    'gte' => [
        'array' => ':attribute должно содержать не менее :value элементов.',
        'file' => ':attribute должно быть не менее :value килобайт.',
        'numeric' => ':attribute должно быть не менее :value.',
        'string' => ':attribute должно содержать не менее :value символов.',
    ],
    'image' => ':attribute должно быть изображением.',
    'in' => 'Выбранное значение :attribute недопустимо.',
    'in_array' => 'Поле :attribute не существует в :other.',
    'integer' => ':attribute должно быть целым числом.',
    'ip' => ':attribute должно быть допустимым IP-адресом.',
    'ipv4' => ':attribute должно быть допустимым IPv4-адресом.',
    'ipv6' => ':attribute должно быть допустимым IPv6-адресом.',
    'json' => ':attribute должно быть допустимой JSON-строкой.',
    'lowercase' => ':attribute должно быть в нижнем регистре.',
    'lt' => [
        'array' => ':attribute должно содержать меньше :value элементов.',
        'file' => ':attribute должно быть меньше :value килобайт.',
        'numeric' => ':attribute должно быть меньше :value.',
        'string' => ':attribute должно содержать меньше :value символов.',
    ],
    'lte' => [
        'array' => ':attribute не должно содержать более :value элементов.',
        'file' => ':attribute не должно быть более :value килобайт.',
        'numeric' => ':attribute не должно быть более :value.',
        'string' => ':attribute не должно содержать более :value символов.',
    ],
    'mac_address' => ':attribute должно быть допустимым MAC-адресом.',
    'max' => [
        'array' => ':attribute не должно содержать более :max элементов.',
        'file' => ':attribute не должно быть более :max килобайт.',
        'numeric' => ':attribute не должно быть более :max.',
        'string' => ':attribute не должно быть более :max символов.',
    ],
    'max_digits' => ':attribute не должно содержать более :max цифр.',
    'mimes' => ':attribute должно быть файлом типа: :values.',
    'mimetypes' => ':attribute должно быть файлом типа: :values.',
    'min' => [
        'array' => ':attribute должно содержать как минимум :min элементов.',
        'file' => ':attribute должно быть как минимум :min килобайт.',
        'numeric' => ':attribute должно быть как минимум :min.',
        'string' => ':attribute должно содержать как минимум :min символов.',
    ],
    'min_digits' => ':attribute должно содержать как минимум :min цифр.',
    'missing' => ':attribute должно быть отсутствующим.',
    'missing_if' => ':attribute должно быть отсутствующим, если :other равно :value.',
    'missing_unless' => ':attribute должно быть отсутствующим, если :other не равно :value.',
    'missing_with' => ':attribute должно быть отсутствующим, если :values присутствует.',
    'missing_with_all' => ':attribute должно быть отсутствующим, если :values присутствуют.',
    'multiple_of' => ':attribute должно быть кратным :value.',
    'not_in' => 'Выбранное значение :attribute недопустимо.',
    'not_regex' => 'Формат поля :attribute недопустим.',
    'numeric' => ':attribute должно быть числом.',
    'password' => [
        'letters' => ':attribute должно содержать как минимум одну букву.',
        'mixed' => ':attribute должно содержать как минимум одну прописную и одну строчную букву.',
        'numbers' => ':attribute должно содержать как минимум одну цифру.',
        'symbols' => ':attribute должно содержать как минимум один символ.',
        'uncompromised' => ':attribute встречается в утечках данных. Пожалуйста, выберите другой :attribute.',
    ],
    'present' => 'Поле :attribute должно присутствовать.',
    'prohibited' => 'Поле :attribute запрещено.',
    'prohibited_if' => 'Поле :attribute запрещено, когда :other равно :value.',
    'prohibited_unless' => 'Поле :attribute запрещено, если :other не равно :value.',
    'prohibits' => 'Поле :attribute запрещает :other.',
    'regex' => 'Формат поля :attribute недопустим.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys' => 'Поле :attribute должно содержать записи для: :values.',
    'required_if' => 'Поле :attribute обязательно, когда :other равно :value.',
    'required_if_accepted' => 'Поле :attribute обязательно, когда :other принято.',
    'required_unless' => 'Поле :attribute обязательно, если :other не равно :values.',
    'required_with' => 'Поле :attribute обязательно, когда :values присутствует.',
    'required_with_all' => 'Поле :attribute обязательно, когда :values присутствуют.',
    'required_without' => 'Поле :attribute обязательно, когда :values отсутствует.',
    'required_without_all' => 'Поле :attribute обязательно, когда ни одно из :values не присутствует.',
    'same' => ':attribute и :other должны совпадать.',
    'size' => [
        'array' => ':attribute должно содержать :size элементов.',
        'file' => ':attribute должно быть :size килобайт.',
        'numeric' => ':attribute должно быть :size.',
        'string' => ':attribute должно содержать :size символов.',
    ],
    'starts_with' => ':attribute должно начинаться с одного из следующих значений: :values.',
    'string' => ':attribute должно быть строкой.',
    'timezone' => ':attribute должно быть допустимым часовым поясом.',
    'unique' => ':attribute уже занято.',
    'uploaded' => ':attribute не удалось загрузить.',
    'uppercase' => ':attribute должно быть в верхнем регистре.',
    'url' => ':attribute должно быть допустимым URL.',
    'ulid' => ':attribute должно быть допустимым ULID.',
    'uuid' => ':attribute должно быть допустимым UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];

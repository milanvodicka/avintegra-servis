<?php

function avintegra_form_config() {

    return [
        'template' => 'form_template.php',
        'message_template' => 'message_template.php',
        'to' => get_bloginfo('admin_email'),
        'subject' => 'Kontaktny formular AV Integra Servis',
        'message' => '<strong>%s</strong>:</br>%s<br/>',
        'ok_message' => 'Vaša požiadavka bola úspešne odoslaná!',
        'error_message' => sprintf(
            'Pri odosielaní požiadavky nastala chyba.<br/>Kontaktujte nás prosím na <strong>%s</strong> alebo na tel. čísle <strong>%s</strong>.',
            get_bloginfo('admin_email'),
            get_option('phone_number')
        ),
    ];
}

function avintegra_form_render($templateFile, $data = []) {
    if (!file_exists(__DIR__ . '/' . $templateFile)) {
        throw new Exception(sprintf('Template file %s does not exist!', __DIR__ . '/' . $templateFile));
    }
    extract($data);
    ob_start();
    require __DIR__ . '/' . $templateFile;
    return ob_get_clean();
}

function avintegra_form_message($postData, $config) {
    $data = [];
    if (empty($postData['_warranty'])) {
        $postData['_warranty'] = null;
    }
    unset($postData['_cantsee']);
    foreach ($postData as $key => $value) {
        $key = str_replace('_', '', $key);
        $data[$key] = $value;
    }

    return avintegra_form_render($config['message_template'], $data);
}

function avintegra_form_process($postData, $config) {
    $valid = TRUE;
    if (
        !empty($postData['_cantsee']) ||
        empty($postData['_name']) ||
        empty($postData['city']) ||
        empty($postData['phone']) ||
        empty($postData['email']) ||
        empty($postData['text'])
    ) {
        $valid = FALSE;
    }
    if (!$valid || !wp_mail(
        $config['to'],
        $config['subject'],
        avintegra_form_message($postData, $config),
        ['Content-Type: text/html; charset=UTF-8']
    )) {
        return ['error' => $config['error_message']];
    } else {
        return ['ok' => $config['ok_message']];
    }
}

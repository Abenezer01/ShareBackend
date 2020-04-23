<?php
return [
  'extensions' => [
      'quill' => [
          // If the value is set to false, this extension will be disabled
          'enable' => true,
          'config' => [
              'modules' => [
                  'syntax' => true,
                  'toolbar' =>
                      [
                          ['size' => []],
                          ['header' => []],
                          'bold',
                          'italic',
                          'underline',
                          'strike',
                          ['script' => 'super'],
                          ['script' => 'sub'],
                          ['color' => []],
                          ['background' => []],
                          'blockquote',
                          'code-block',
                          ['list' => 'ordered'],
                          ['list' => 'bullet'],
                          ['indent' => '-1'],
                          ['indent' => '+1'],
                          'direction',
                          ['align' => []],
                          'link',
                          'image',
                          'video',
                          'formula',
                          'clean'
                      ],
              ],
              'theme' => 'snow',
              'height' => '200px',
          ]
      ]
  ]
]
 ?>

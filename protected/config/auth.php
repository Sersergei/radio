<?php
return array(
'guest' => array(
'type' => CAuthItem::TYPE_ROLE,
'description' => 'Guest',
'bizRule' => null,
'data' => null
),
'user' => array(
'type' => CAuthItem::TYPE_ROLE,
'description' => '3',
'children' => array(
'guest', // ������������ �� �����
),
'bizRule' => null,
'data' => null
),
'moderator' => array(
'type' => CAuthItem::TYPE_ROLE,
'description' => '2',
'children' => array(
'user',          // �������� ���������� ��, ��� ��������� ������������
),
'bizRule' => null,
'data' => null
),
'administrator' => array(
'type' => CAuthItem::TYPE_ROLE,
'description' => '1',
'children' => array(
'moderator',         // �������� ������ ��, ��� ��������� ����������
),
'bizRule' => null,
'data' => null
),
);
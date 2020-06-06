<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute(''));
        $I->see('Рублевское предместье');

        $I->seeLink('Контакт');
        $I->click('Контакт');
        $I->wait(2); // wait for page to be opened

        $I->see('Если у вас есть деловые вопросы или другие вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.');
        $I->wait(3); // wait for page to be opened
        $I->click('Регистрация');
        $I->wait(3); // wait for page to be opened
    }
}

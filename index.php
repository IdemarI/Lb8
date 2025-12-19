<?php
require_once 'InvalidAmountException.php';
require_once 'InsufficientFundsException.php';
require_once 'BankAccount.php';

use mrmzn\lb8\BankAccount;
use mrmzn\lb8\Exception\InvalidAmountException;
use mrmzn\lb8\Exception\InsufficientFundsException;

function displayMenu(): void
{
    echo "\nБанковский счет - Меню:\n";
    echo "1. Создать новый счет\n";
    echo "2. Показать баланс\n";
    echo "3. Пополнить счет\n";
    echo "4. Снять деньги\n";
    echo "5. Выход\n";
    echo "Выберите действие: ";
}

function getNumericInput(string $prompt): float
{
    while (true) {
        echo $prompt;
        $input = trim(fgets(STDIN));

        if (is_numeric($input)) {
            return (float)$input;
        }

        echo "Ошибка: Введите числовое значение.\n";
    }
}

$account = null;

while (true) {
    displayMenu();
    $choice = trim(fgets(STDIN));

    try {
        switch ($choice) {
            case '1':
                $initialBalance = getNumericInput("Введите начальный баланс: ");
                $account = new BankAccount($initialBalance);
                echo "Счет успешно создан с балансом: " . $account->getBalance() . "\n";
                break;

            case '2':
                if ($account === null) {
                    echo "Ошибка: Счет не создан. Сначала создайте счет.\n";
                } else {
                    echo "Текущий баланс: " . $account->getBalance() . "\n";
                }
                break;

            case '3':
                if ($account === null) {
                    echo "Ошибка: Счет не создан. Сначала создайте счет.\n";
                } else {
                    $amount = getNumericInput("Введите сумму для пополнения: ");
                    $account->deposit($amount);
                    echo "Счет успешно пополнен. Новый баланс: " . $account->getBalance() . "\n";
                }
                break;

            case '4':
                if ($account === null) {
                    echo "Ошибка: Счет не создан. Сначала создайте счет.\n";
                } else {
                    $amount = getNumericInput("Введите сумму для снятия: ");
                    $account->withdraw($amount);
                    echo "Средства успешно сняты. Новый баланс: " . $account->getBalance() . "\n";
                }
                break;

            case '5':
                echo "До свидания!\n";
                exit(0);

            default:
                echo "Неверный выбор. Попробуйте снова.\n";
        }
    } catch (InvalidAmountException $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    } catch (InsufficientFundsException $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }
}
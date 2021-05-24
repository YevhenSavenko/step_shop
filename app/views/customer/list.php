<?php $customers = $this->get('customers') ?>
<?php if (count($customers) > 0) : ?>
    <div class="my-5">
        <h2 class="text-center">
            Список всіх клієнтів
        </h2>
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr class="text-center">
                <th class="px-5 py-3" scope="col">Id</th>
                <th class="px-3 py-3" scope="col">Прізвище</th>
                <th class="px-3 py-3" scope="col">Ім'я</th>
                <th class="py-3" scope="col">Номер телефону</th>
                <th class="py-3" scope="col">E-mail</th>
                <th class="py-3" scope="col">city</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
                <tr class="text-center">
                    <th class="px-5 text-center" scope="row"><?= $customer['customer_id'] ?></th>
                    <td class="px-3"><?= $customer['last_name'] ?></td>
                    <td class="px-3"><?= $customer['first_name'] ?></td>
                    <td><?= $customer['telephone'] ?></td>
                    <td><?= $customer['email'] ?></td>
                    <td><?= $customer['city'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php else : ?>
    <div>
        Клієнти відсутні
    </div>
<?php endif ?>
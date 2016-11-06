<h1>Route</h1>

<div class="tracy-inner">
    <table>
        <tbody>
            <?php foreach ($action as $key => $value): ?>
                <tr>
                    <th><?php echo $key ?></th>
                    <td>
                        <?php echo Tracy\Dumper::toHtml($value, [Tracy\Dumper::LIVE => true]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

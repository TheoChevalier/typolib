<?php if (! empty($result)) : ?>
<div id="mainform">
    <p>We’ve checked the file you’ve sent, find the results below.</p>

    <h2>Stats</h2>
    <br/><b>Number of strings:</b> <?= sizeof($array) ?>
    <br/><b>Number of potential mistakes:</b> <?= sizeof($result) ?>
    <br/>
    <h2>Potential mistakes</h2>
</div>
<table>
    <tr class="column_headers">
        <th>Original string</th>
        <th>Corrected string</th>
        <th>Error message</th>
    </tr>
    <?php
    if (! empty($result)) {
        foreach ($result as $string => $error) {
            echo "<tr>\n<td>" . $string . "</td>\n"
               . "<td>" . $error[0] . "</td>\n"
               . "<td>";
            foreach ($error[1] as $comment) {
                echo $comment . '<br/>';
            }
            echo "</td>\n</tr>";
        }
    }
    ?>
</table>

<?php else: ?>
<div id="mainform">
    <a href="/check-file" class="button">Try again</a>
</div>
<?php endif; ?>

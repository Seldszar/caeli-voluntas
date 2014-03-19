<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
<title><?= $title_for_layout ?></title>
</head>
<body style="background-color: #212121; padding: 20px;">
<table width="100%">
<tr>
<td align="center">
<table style="color: #E6E6E6; font: 13px 'Open Sans', Arial, sans-serif; width: 600px;">
<tr>
<td colspan="2" style="width: 200px; padding-bottom: 10px;">
<?= $this->Html->image('logo.png') ?>
</td>
</tr>
<tr>
<td colspan="2" style="padding: 10px 0;">
<?= $content_for_layout ?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>

<?php
/* @var $this IntFriendsController */
/* @var $data IntFriends */
?>
<tr>
    <td><?php echo CHtml::encode($data->firstname); ?></td>
    <td><?php echo CHtml::encode($data->lastname); ?></td>
    <td><?php echo CHtml::encode($data->email); ?></td>
    <td><img src="<?php echo CHtml::encode($data->image_url); ?>" height="60" width="60" class="img-circle" class=""/></td>
    <td><?php echo CHtml::encode($data->uniq_id); ?></td>
    <td><?php echo CHtml::encode($data->network); ?></td>
    <td><?php echo CHtml::link("Invite", "javascript:void(0)", array("id" => $data->uniq_id, "class" => "invite", "onclick" => "return openInvitaion('$data->network','$data->uniq_id')"));
?>
    </td>
</tr>

<?php if(!isset($title) && !isset($value) && !isset($display)): ?>
    <?php (__("Tablo Oluşturulamadı.")); ?>
<?php else: ?>
    <?php if(isset($id)): ?>
        <?php ($rand = $id); ?>
    <?php else: ?>
        <?php ($rand = str_random(10)); ?>
    <?php endif; ?>
    <?php if(!isset($startingNumber)): ?>
        <?php ($startingNumber = 0); ?>
    <?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-hover dataTable <?php if(isset($noInitialize)): ?><?php echo e("notDataTable"); ?><?php endif; ?>" id="<?php echo e($rand); ?>" style="width: 100%">
        <thead>
        <tr>
            <?php if(isset($sortable) && $sortable): ?>
              <th scope="col"><?php echo e(__("Taşı")); ?></th>
            <?php endif; ?>
            <th scope="col">#</th>
            <?php $__currentLoopData = $title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($i == "*hidden*"): ?>
                    <th scope="col" hidden><?php echo e(__($i)); ?></th>
                <?php else: ?>
                    <th scope="col"><?php echo e(__($i)); ?></th>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($menu)): ?>
            <th scope="col" class="menu-col">

            </th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="tableRow" <?php if(isset($k->id)): ?> data-id="<?php echo e($k->id); ?>" <?php endif; ?> id="<?php echo e(str_random(10)); ?>">
                <?php if(isset($sortable) && $sortable): ?>
                  <td style="width: 10px; text-align: center;"><i class="fas fa-arrows-alt"></i></td>
                <?php endif; ?>
                <td style="width: 10px" class="row-number"><?php echo e($loop->iteration + $startingNumber); ?></td>
                <?php $__currentLoopData = $display; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count(explode(':',$item)) > 1): ?>
                        <?php if(is_array($k)): ?>
                            <td <?php if(isset($onclick)): ?>style="cursor: pointer;" onclick="<?php echo e($onclick); ?>(this.parentElement)" <?php endif; ?> id="<?php echo e(explode(':',$item)[1]); ?>" hidden><?php echo e($k[explode(':',$item)[0]]); ?></td>
                        <?php else: ?>
                            <td <?php if(isset($onclick)): ?>style="cursor: pointer;" onclick="<?php echo e($onclick); ?>(this.parentElement)" <?php endif; ?> id="<?php echo e(explode(':',$item)[1]); ?>" hidden><?php echo e($k->__get(explode(':',$item)[0])); ?></td>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(is_array($k)): ?>
                            <td <?php if(isset($onclick)): ?>style="cursor: pointer;" onclick="<?php echo e($onclick); ?>(this.parentElement)" <?php endif; ?> id="<?php echo e($item); ?>"><?php echo e(array_key_exists($item,$k) ? $k[$item] : ""); ?></td>
                        <?php else: ?>
                            <td <?php if(isset($onclick)): ?>style="cursor: pointer;" onclick="<?php echo e($onclick); ?>(this.parentElement)" <?php endif; ?> id="<?php echo e($item); ?>"><?php echo e($k->__get($item)); ?></td>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($menu)): ?>
                <td id="<?php echo e($rand); ?>-click" class="table-menu" style="text-align: right; padding-right: 18px;">
                    <i class="fas fa-ellipsis-v"></i>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
    <?php if(isset($menu)): ?>
        <style>
            .menu-col {
                padding-right: 0 !important;
                cursor: default !important;
            }
            .menu-col::before {
                right: 0 !important;
                content: "" !important;
            }
            
            .menu-col::after {
                right: 0 !important;
                content: "" !important;
            }
        </style>
        <script>
            $(".menu-col").off("click");

            <?php if(isset($sortable) && $sortable): ?>
              $('#<?php echo e($rand); ?>').find('tbody').sortable({
                  stop: function(event, ui) {
                      var data = [];
                      $('#<?php echo e($rand); ?>').find('tbody').find('tr').each(function(i, el){
                          $(el).attr('data-order', $(el).index());
                          $(el).find('.row-number').text($(el).index()+1);
                          data.push({
                            id: $(el).attr('data-id'),
                            order:  $(el).index()
                          });
                      });
                      <?php if(isset($sortUpdateUrl) && $sortUpdateUrl): ?>
                        var form = new FormData();
                        form.append('data', JSON.stringify(data));
                        request('<?php echo e($sortUpdateUrl); ?>', form, function(response){
                          <?php echo e($afterSortFunction); ?>();
                        });
                      <?php endif; ?>
                  }
              });
            <?php endif; ?>

            <?php if(isset($setCurrentVariable)): ?>
            var <?php echo e($setCurrentVariable); ?>;
            <?php endif; ?>
            <?php if(count($value) > 0): ?>
           
            $.contextMenu({
                selector: '#<?php echo e($rand); ?>-click',
                trigger: 'left',
                callback: function (key, options) {
                    <?php if(isset($setCurrentVariable)): ?>
                    <?php echo e($setCurrentVariable); ?> = options.$trigger[0].getAttribute("id");
                    <?php endif; ?>
                    var target = $("#" + key);
                    if(target.length === 0){
                        window[key](options.$trigger[0]);
                        return;
                    }
                    inputs =[];
                    $("#" + key + " input , #" + key + ' select').each(function (index, value) {
                        var element_value = $("#" + options.$trigger[0].getAttribute("id") + " #" + value.getAttribute('name')).text();
                        if(element_value){
                            inputs.push($("#" + options.$trigger[0].getAttribute("id") + " #" + value.getAttribute('name')));
                            $("#" + key + " select[name='" + value.getAttribute('name') + "']" + " , "
                                + "#" + key + " input[name='" + value.getAttribute('name') + "']").val(element_value).prop('checked', true);
                        }
                    });
                    target.modal('show');
                },
                items: {
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name=>$config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($config['target']); ?>" : {name: "<?php echo e(__($name)); ?>" , icon: "<?php echo e($config['icon']); ?>"},
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                }
            });

            $.contextMenu({
                selector: '#<?php echo e($rand); ?> tbody tr',
                callback: function (key, options) {
                    <?php if(isset($setCurrentVariable)): ?>
                    <?php echo e($setCurrentVariable); ?> = options.$trigger[0].getAttribute("id");
                    <?php endif; ?>
                    var target = $("#" + key);
                    if(target.length === 0){
                        window[key](options.$trigger[0]);
                        return;
                    }
                    inputs =[];
                    $("#" + key + " input , #" + key + ' select').each(function (index, value) {
                        var element_value = $("#" + options.$trigger[0].getAttribute("id") + " #" + value.getAttribute('name')).text();
                        if(element_value){
                            inputs.push($("#" + options.$trigger[0].getAttribute("id") + " #" + value.getAttribute('name')));
                            $("#" + key + " select[name='" + value.getAttribute('name') + "']" + " , "
                                + "#" + key + " input[name='" + value.getAttribute('name') + "']").val(element_value).prop('checked', true);
                        }
                    });
                    target.modal('show');
                },
                items: {
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name=>$config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($config['target']); ?>" : {name: "<?php echo e(__($name)); ?>" , icon: "<?php echo e($config['icon']); ?>"},
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                }
            });
            <?php endif; ?>
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /liman/server/resources/views/components/table.blade.php ENDPATH**/ ?>
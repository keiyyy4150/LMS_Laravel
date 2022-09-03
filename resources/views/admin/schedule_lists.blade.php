<?php $__env->startSection('content'); ?>
<main class="col-md-11">
    <div class="conteiner">
        <a href="./manager_home">
           <button type='button' class='btn btn-danger'>生徒管理画面に切り替える</button>
        </a>
    </div>
    <div class="conteiner">
        <div class="card shadow">
            <div class="border">
                <h4>【トップ画面お知らせ】</h>
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr><th>現在公開中のお知らせ</th></tr>
                    </thead>
                    <tbody>
                        <tr><td> <?php echo e($notice['notice']); ?> </td></tr>
                    </tbody>
                </table> 
                    <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#update_setting<?php echo e($notice['id']); ?>">編集</button>
                    <!-- 以下モーダル -->
                    <div class="modal" id="update_setting<?php echo e($notice['id']); ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form action="<?php echo e(route('update.setting', ['id' => $notice['id']])); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <p>トップページお知らせ内容</p>
                                        <textarea class='form-control' name='notice' type="text"></textarea>
                            <div class='row justify-content-center'>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- モーダルここまで -->
            </div>
        </div>
    </div>
    <div class="conteiner">
        <div class="card shadow">
            <div class="border">
                <h4>【課題作成】</h>
                <button type='button' class='btn btn-primary' data-toggle="modal" data-target="#modal-example2">新規作成</button>
                <div class="modal" id="modal-example2" tabindex="-1">
                    <div class="modal-dialog">
                    <!-- 以下モーダル -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="<?php echo e(route('create.assign')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <label for='assignname'>課題名</label>
                                    <input type='text' class='form-control' name='assignname' value=""/>
                                <label for='explanation'>内容</label>
                                    <textarea class='form-control' name='explanation' type="text"></textarea>
                                <label for='deadline'>期限</label>
                                    <input type='datetime-local' class='form-control' name='deadline' value=""/>
                                <label for='course_id'>公開範囲</label>
                                <select name='course_id' class='form-control'>
                                    <option value='' hidden>公開範囲</option>
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($course['id']); ?>"><?php echo e($course['coursename']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                    <button type="submit" class="btn btn-primary">保存</button>
                                </div>
                            </form>
                    </div>
                </div>
                </div>
                <!-- モーダルここまで -->
                <table class="table table-light table-bordered table-striped ">
                    <thead class="thead-light">
                        <tr>
                            <th>課題名</th>
                            <th>内容</th>
                            <th>期限</th>
                            <th>公開状況</th>
                            <th>公開範囲</th>
                            <th>公開設定</th>
                            <th>設定</th>
                        </tr>
                    </thead>
                    <tbody><?php $__currentLoopData = $assignDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($assignDetail['assignname']); ?></td>
                            <td><?php echo e($assignDetail['explanation']); ?></td>
                            <td><?php echo e($assignDetail['deadline']); ?></td>
                            <td><?php if($assignDetail['private_flg'] === 0): ?>
                                <p>非公開</p>
                                <?php elseif($assignDetail['private_flg'] === 1): ?>
                                <p>公開中</P>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($course['coursename']); ?></td>
                            <td><?php if($assignDetail['private_flg'] === 0): ?>
                                <a href="<?php echo e(route('open.assignment', ['id' => $assignDetail['id']])); ?>">
                                    <button type='button' class='btn btn-danger'>公開</button>
                                </a>
                                <?php elseif($assignDetail['private_flg'] === 1): ?>
                                <a href="<?php echo e(route('close.assignment', ['id' => $assignDetail['id']])); ?>">
                                <button type='button' class='btn btn-secondary'>非公開</button>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td><a href="" data-toggle="modal" data-target="#update_assignment<?php echo e($assignDetail['id']); ?>">編集</a>・<a href="<?php echo e(route('delete.assignment', ['id' => $assignDetail['id']])); ?>">削除</a></td></tr>
                            <!-- 以下モーダル -->
                            <div class="modal" id="update_assignment<?php echo e($assignDetail['id']); ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="<?php echo e(route('update.assignment', ['id' => $assignDetail['id']])); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <label for='assignname'>課題名</label>
                                            <input type='text' class='form-control' name='assignname' value="<?php echo e($assignDetail['assignname']); ?>" />
                                        <label for='explanation'>内容</label>
                                            <textarea class='form-control' name='explanation' type="text" value="<?php echo e($assignDetail['explanation']); ?>"></textarea>
                                        <label for='deadline'>期限</label>
                                            <input type='datetime-local' class='form-control' name='deadline' value="<?php echo e($assignDetail['deadline']); ?>"/>
                                        <label for='course_id'>公開範囲</label>
                                        <select name='course_id' class='form-control'>
                                            <option value='' hidden>公開範囲</option>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($course['id']); ?>"><?php echo e($course['coursename']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- モーダルここまで -->
                    </tbody><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
    </div>
</main>
<?php $__env->stopSection(); ?>
    </div>
</body>
</html>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Laravel_Portfolio/resources/views/managers/manager_setting.blade.php ENDPATH**/ ?>
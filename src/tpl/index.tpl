<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>think-logs</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md">
            <table class="table">
                <thead>
                <tr>
                    <th>文件/文件夹名称</th>
                    <th>文件创建时间</th>
                    <th>地址</th>
                </tr>
                </thead>
                <tbody>
                {volist name="list" id="vo"}
                    <tr>
                        <td>
                            {eq name='vo.file_type' value='dir'}
                                <a href="/{$dir}?dir={$vo.min_path}">
                                    {$vo.path}
                                </a>
                            {else/}
                                <a href="/{$file}?path={$vo.min_path}">
                                    {$vo.path}
                                </a>
                            {/eq}
                        </td>
                        <td>{$vo.create_time}</td>
                        <td>{$vo.file_type}</td>
                    </tr>
                {/volist}
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--    <table>-->
<!--        <tbody>-->

<!--        </tbody>-->
<!--    </table>-->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
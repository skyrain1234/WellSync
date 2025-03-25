<select id="statusFilter" class="form-select  w-25 ms-auto me-auto mt-2 ">
    <option value="" >查看全部</option>
    <option value="unpaid" >未付款</option>
    <option value="pending" >已付款</option>
    <option value="processing">撿貨中</option>
    <option value="shipped">運送中</option>
    <option value="completed">已完成</option>
    <option value="canceled">已取消</option>
</select>
{{ $dataTable->table() }}
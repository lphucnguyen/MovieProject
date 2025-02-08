@if($status === 'pending')
    <span class="badge bg-warning">{{ucfirst($status)}}</span>
@elseif($status === 'processing')
    <span class="badge bg-secondary">{{ucfirst($status)}}</span>
@elseif($status === 'canceled')
    <span class="badge bg-danger">{{ucfirst($status)}}</span>
@elseif($status === 'completed')
    <span class="badge bg-success">{{ucfirst($status)}}</span>
@endif
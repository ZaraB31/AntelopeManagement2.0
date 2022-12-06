@if($userType->userType_id === 1)
    @include('includes.officeHome')
@elseif($userType->userType_id === 3)
    @include('includes.fieldHome')
@endif
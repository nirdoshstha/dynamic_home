{{-- @foreach (modals() as $modal)
    <div class="modal fade myModal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered popover_before">

            <div class="modal-content border-0">
 <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                @if (isset($modal->title))
                    <div class="modal-header py-2 px-0 p-0 m-0">
                        <h5 class="modal-title mx-auto" id="exampleModalLabel">{{ $modal->title }}</h5>
                    </div>
                @endif
                <div class="modal-body p-0">
                    @if (isset($modal->image))
                        <a href="{{ isset($modal->link) ? $modal->link : '#' }}" target="_blank">
                            <img src="{{ asset('storage/' . $modal->image) }}" width="100%" height="100%"
                                alt="" style="object-fit: cover; max-height: 500px;">
                        </a>
                    @endisset
            </div>

            @isset($modal->file)
                <div class="bg-transparent mx-auto mt-2 mb-2">
                    <div class="bg-transparent">
                        <a href="{{ asset('storage/' . $modal->file) }}" target="_blank" class="btn btn-primary"><i
                                class="fas fa-print"></i> Download File</a>
                    </div>
                </div>
            @endisset

        </div>
    </div>
</div>
@endforeach --}}


@foreach (modals() as $modal)
    {{-- 
<div class="modal fade myModal" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md popover_before">
        <div class="modal-content border-0" style="overflow: hidden; background: transparent;" >


        <button type="button" class="ms-auto text-danger fw-bold bg-transparent border-0" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close" style="font-size:22px;color:red"></i></button>
             <div class="bg-light w-100 mt-2">
                @isset($modal->title)
                <div class="modal-header m-0 p-0">
                    <h5 class="modal-title mx-auto " id="exampleModalLabel">{{$modal->title ?? ''}}</h5>
                </div>
                @endisset
            </div>


            @isset($modal->image)
                <div class="modal-body p-0">
                    <a href="{{isset($modal->link) ? $modal->link : '#'}}" target="_blank">
                        <img src="{{asset('storage/'.$modal->image)}}" width="100%"  alt=""
                            style="object-fit: cover; height:500px;">
                    </a>
                </div>
            @endisset

            @isset($modal->file)
            <div class="modal-foot btn btn-primary bg-transparent mx-auto mt-0 mb-2 border-0">
                <div class="text-center">
                    <a href="{{asset('storage/'.$modal->file)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i> Application Form</a>
                </div>
            </div>
        @endisset
        </div>
    </div>
</div> --}}
@endforeach

<div id="contact-form">
    <h1>{{ __('text.forms.contact.title') }}</h1>

    <form action="{{ route('contacts.store') }}" method="post">
        @csrf
        
        @include('components.elements.input', ['name' => 'name', 'required' => true])
        @include('components.elements.input', ['name' => 'email', 'type' => 'email', 'required' => true])

        @include('components.elements.textarea', ['name' => 'message'])

        @include('components.elements.submit')
    </form>
</div>
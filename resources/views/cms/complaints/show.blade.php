<div class="content-panel">
    <div class="title">
        <span class="subject">{{ $complaint->subject }}</span>
        <br>
        <span class="email"><b>Date:</b> {{ $complain->date }}</span>
        <br>
        <span class="fullname"><b>Name:</b> {{ $complain->first_name }} {{ $complain->middle_name }} {{ $complain->last_name }}</span>
        <br/>
        <span class="email"><b>Work:</b> {{ $complain->work }}</span>
        <br>
        <span class="email"><b>Designation:</b> {{ $complain->designation }} </span>
        <br>
        <span class="email"><b>Address:</b> {{ $complain->address }}</span>
        <br>
        <span class="phone"><b>Phone:</b> {{ $complain->phone }}</span>
        <br>
        <span class="email"><b>Fax: </b>{{ $complain->fax }}</span>
        <br>
        <span class="email"> <b>Internal/External:</b> {{ $complain->customer_type }}</span>
        <br>
        <span class="email"><b>Complainant:</b> {{ $complain->complainant->name }}</span>
        <br>
        <span class="email"><b>Grievance level:</b> {{ $complain->grievance_level->name_en }}</span>
        <br>
        <span class="email"><b>Subject:</b> {{ $complain->subject }}</span>
        <br>
        <span class="email"><b>Defect:</b> {{ $complain->defect }}</span>
        <br>
        <span class="email"><b>Location:</b> {{ $complain->location }}</span>
        <br>
        <span class="email"><b>Has complained before:</b> {{ $complain->complained_before == true ? "Yes": "No" }}</span>
    </div>

    <div class="content">
        <p class="message">{{ $complain->message }}</p>
    </div>
</div>
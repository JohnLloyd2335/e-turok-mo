<table>
    <thead>
        <tr>
            <th>Immunization ID</th>
            <th>Immunization Category</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Age</th>
            <th>Date of Birth</th>
            <th>Place of Birth</th>
            <th>Address</th>
            <th>Contact no.</th>
            <th>Mother</th>
            <th>Father</th>
            <th>Weight</th>
            <th>Height</th>
            <th>Gender</th>
            <th>Vaccine Received</th>
            <th>Dose(s)</th>
            <th>Dose(s) Received</th>
            <th>First Dose Schedule</th>
            <th>Location</th>
            <th>Second Dose Schedule</th>
            <th>Location</th>
            <th>Third Dose Schedule</th>
            <th>Location</th>
            <th>Remarks</th>
            <th>Date Recorded</th>
           
        </tr>
    </thead>
    <tbody>
           @foreach ($immunizations as $immunization)
          <tr>
            <td>{{$immunization->id}}</td>
            <td>{{$immunization->immunization_category->immunization_category_name}}</td>
            <td>{{$immunization->first_name}}</td>
            <td>{{$immunization->middle_name}}</td>
            <td>{{$immunization->last_name}}</td>
            <td>{{$immunization->age}}</td>
            <td>{{$immunization->date_of_birth}}</td>
            <td>{{$immunization->place_of_birth}}</td>
            <td>{{$immunization->address}}</td>
            <td>{{$immunization->contact_no}}</td>
            <td>{{$immunization->mother_full_name}}</td>
            <td>{{$immunization->father_full_name}}</td>
            <td>{{$immunization->weight}}</td>
            <td>{{$immunization->height}}</td>
            <td>{{$immunization->gender}}</td>
            <td>{{$immunization->vaccine_received}}</td>
            <td>{{$immunization->doses}}</td>
            <td>{{$immunization->doses_received}}</td>
            <td>{{$immunization->first_dose_schedule}}</td>
            <td>{{$immunization->first_dose_vaccinated_at}}</td>
            <td>{{$immunization->second_dose_schedule}}</td>
            <td>{{$immunization->second_dose_vaccinated_at}}</td>
            <td>{{$immunization->third_dose_schedule}}</td>
            <td>{{$immunization->third_dose_vaccinated_at}}</td>
            <td>{{$immunization->remarks}}</td>
            <td>{{$immunization->date_recorded}}</td>
          </tr>
          @endforeach
    </tbody>
</table>
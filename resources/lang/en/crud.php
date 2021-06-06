<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'trusts' => [
        'name' => 'Trusts',
        'index_title' => 'Trusts List',
        'create_title' => 'Create Trust',
        'edit_title' => 'Edit Trust',
        'show_title' => 'Show Trust',
        'inputs' => [
            'name' => 'Name',
            'logo' => 'Logo',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'trust_id' => 'Trust',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ],
    ],

    'campaigns' => [
        'name' => 'Campaigns',
        'index_title' => 'Campaigns List',
        'create_title' => 'Create Campaign',
        'edit_title' => 'Edit Campaign',
        'show_title' => 'Show Campaign',
        'inputs' => [
            'trust_id' => 'Trusts',
            'content' => 'Content',
            'title' => 'Title',
            'condition' => 'Condition',
            'subcondition' => 'Subcondition',
            'published' => 'Published',
        ],
    ],

    'patients' => [
        'name' => 'Patients',
        'index_title' => 'Patients List',
        'create_title' => 'Create Patient',
        'edit_title' => 'Edit Patient',
        'show_title' => 'Show Patient',
        'inputs' => [
            'name' => 'Name',
            'dob' => 'Date of Birth',
            'nhsnum' => 'NHS Number',
            'phone' => 'Phone',
            'email' => 'Email',
            'notes' => 'Notes',
        ],
        'tbl_action' => 'Action',
    ],

    'keydates' => [
        'name' => 'Keydates',
        'index_title' => 'Keydates List',
        'create_title' => 'Create Keydate',
        'edit_title' => 'Edit Keydate',
        'show_title' => 'Show Keydate',
        'inputs' => [
            'type' => 'Type',
            'test_order' => 'Test Order',
            'next_test_order' => 'Next Test Order',
            'lab_ref' => 'Lab Ref',
            'next_appointment' => 'Next Appointment',
            'apt_date' => 'Apt Date',
            'campaign_num' => 'Campaign Num',
            'test_type_id' => 'Test Type',
            'result' => 'Test Result',
            'patient_id' => 'Patient Id',
        ],
    ],

    'outbounds' => [
        'name' => 'Outbounds',
        'index_title' => 'Outbounds List',
        'create_title' => 'Create Outbound',
        'edit_title' => 'Edit Outbound',
        'show_title' => 'Show Outbound',
        'inputs' => [
            'keydate_id' => 'Keydate',
            'recipient' => 'Recipient',
            'trust' => 'Trust',
            'trust_logo' => 'Trust Logo',
            'message' => 'Message',
            'message_data' => 'Message Data',
        ],
    ],

    'libraries' => [
        'name' => 'Libraries',
        'index_title' => 'Libraries List',
        'create_title' => 'Create Library',
        'edit_title' => 'Edit Library',
        'show_title' => 'Show Library',
        'inputs' => [
            'campaign_id' => 'Campaign',
            'message_title' => 'Title',
            'content' => 'Content',
            'date' => 'Data/Time Rule',
            'published' => 'Published',
        ],
    ],

    'test_types' => [
        'name' => 'Test Types',
        'index_title' => 'TestTypes List',
        'create_title' => 'Create TestType',
        'edit_title' => 'Edit TestType',
        'show_title' => 'Show TestType',
        'inputs' => [
            'test_name' => 'Test Name',
        ],
    ],

    'patient_messages' => [
        'name' => 'Patient Messages',
        'index_title' => 'PatientMessages List',
        'create_title' => 'Create PatientMessage',
        'edit_title' => 'Edit PatientMessage',
        'show_title' => 'Show PatientMessage',
        'inputs' => [
            'patient_id' => 'Patient',
            'patient_campaign_id' => 'Patient Campaign',
            'library_id' => 'Library',
            'content' => 'Content',
            'data' => 'Data',
        ],
    ],

    'patient_campaigns' => [
        'name' => 'Patient Campaigns',
        'index_title' => 'PatientCampaigns List',
        'create_title' => 'Create PatientCampaign',
        'edit_title' => 'Edit PatientCampaign',
        'show_title' => 'Show PatientCampaign',
        'inputs' => [
            'patient_id' => 'Patient',
            'title' => 'Title',
            'condition' => 'Condition',
            'subcondition' => 'Subcondition',
            'campaign_id' => 'Campaign',
            'content' => 'Content',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];

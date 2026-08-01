<h2>Payroll Batch</h2>

<p>

    Payroll Period:

    {{ $period_start }}

    -

    {{ $period_end }}

</p>

<table border="1" cellpadding="10" width="100%">

    <tr>

        <th>Employee</th>

        <th>Department</th>

        <th>Net Salary</th>

        <th>Action</th>

    </tr>

    @foreach($payslips as $payslip)

    <tr>

        <td>

            {{ $payslip->user->first_name }}
            {{ $payslip->user->last_name }}

        </td>

        <td>

            {{ $payslip->user->department }}

        </td>

        <td>

            ₱{{ number_format($payslip->net_salary,2) }}

        </td>

        <td>

            <!-- View Individual Payslip -->
            <a href="{{ route('admin.payslips.show', $payslip->id) }}">
                👁 View
            </a>

            |

            <!-- PDF (we will make this work next) -->
            <a href="#">
                📄 PDF
            </a>

            |

            <!-- Send (we will make this work later) -->
            <a href="#">
                ✉ Send
            </a>

        </td>

    </tr>

    @endforeach

</table>
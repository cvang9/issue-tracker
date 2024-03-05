import { render, screen} from '@testing-library/vue'
import userEvent from '@testing-library/user-event'
import TicketForm from '../../components/User/TicketForm.vue'
// import apiClient from '../../services/api'
import { describe, expect, it} from 'vitest'

const mockPost = (url, payload) => {
    return new Promise((resolve, reject) => {
      if (payload.title === '' || payload.body === '' || payload.department === '') {
        reject(new Error('Missing fields'))
      } else {
        resolve({ data: {} })
      }
    })
  }
  
  const apiClient = {};
  apiClient.post = mockPost
  

describe('TicketForm.vue', () => {
    
  it('renders the inputs for ticket form correctly', async () => {
    render(TicketForm)

    expect(screen.getByText('Create a Ticket')).toBeInTheDocument()
    expect(screen.getByLabelText('Ticket Title')).toBeInTheDocument()
    expect(screen.getByLabelText('Describe Your Issue')).toBeInTheDocument()
    expect(screen.getByLabelText('Choose department')).toBeInTheDocument()
  })

  it('renders the buttons in ticket form correctly', async () => {
    render(TicketForm)

    expect(screen.getByRole('button', { name: 'Cancel' })).toBeInTheDocument()
    expect(screen.getByRole('button', { name: 'Create' })).toBeInTheDocument()
  })

  it('submits the form successfully when all fields are filled', async () => {
    render(TicketForm)

    await userEvent.type(screen.getByLabelText('Ticket Title'), 'Test Ticket Title')
    await userEvent.type(screen.getByLabelText('Describe Your Issue'), 'Test Issue Description')

    await userEvent.click(screen.getByRole('button', { name: 'Create' }))

    expect(screen.getByLabelText('Ticket Title')).toHaveValue('')
    expect(screen.getByLabelText('Describe Your Issue')).toHaveValue('')
  })

  it('displays error message when form fields are empty on submission', async () => {
    render(TicketForm)

    await userEvent.click(screen.getByRole('button', { name: 'Create' }))

    expect(screen.getByText('*Please fill all the fields')).toBeInTheDocument()
  })

})

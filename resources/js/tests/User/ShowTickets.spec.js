import { render, screen } from '@testing-library/vue'
import TopHeading from '../../components/User/TopHeading.vue'
// import TicketForm from '@/components/TicketForm.vue'
import ShowTickets from '../../components/User/ShowTickets.vue'
import { describe, expect, it} from 'vitest'
import { useAdminStore } from '../../store/admin.js'
import { createPinia } from 'pinia';

describe('ShowTickets.vue', () => {

  it('renders TempFile component with correct props', () => {
    render(TopHeading, { props: { head: 'Your Issues :' } })
    const tempFile = screen.getByTestId('temp-file')
    expect(tempFile).toBeInTheDocument()
    expect(tempFile).toHaveTextContent(')')
  })

  // it('displays correct messages when no issues are available', async () => {
  //   // Render the component with initial state where no issues are available
  //   const store = useAdminStore(createPinia());

  //       const { setData } = store;

  //       // Mock data
  //       const adminData = {
  //         name: 'John Doe',
  //         img: 'profile.jpg',
  //         created_at: '2022-01-01',
  //       };
      
  //       // Set data using the setData action
  //       setData(adminData);
  //   render(ShowTickets, {
  //     data() {
  //       return {
  //         loading: false,
  //         showAllIssues: [],
  //         issues: [],
  //         // other necessary data properties
  //       }
  //     }
  //   })

  //   // Assert that the appropriate messages are displayed
  //   expect(screen.getByText('No Issue raised yet')).toBeInTheDocument()
  //   expect(screen.getByText('No Issues in this state')).toBeInTheDocument()
  // })

});
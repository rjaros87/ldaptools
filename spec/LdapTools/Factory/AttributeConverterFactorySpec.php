<?php
/**
 * This file is part of the LdapTools package.
 *
 * (c) Chad Sikorra <Chad.Sikorra@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\LdapTools\Factory;

use LdapTools\AttributeConverter\AttributeConverterInterface;
use LdapTools\Connection\LdapConnectionInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AttributeConverterFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LdapTools\Factory\AttributeConverterFactory');
    }

    function it_should_return_ConvertBoolean_when_calling_get_with_bool()
    {
        $this::get('bool')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertBoolean');
    }

    function it_should_return_ConvertGeneralizedTime_when_calling_get_with_generalized_time()
    {
        $this::get('generalized_time')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertGeneralizedTime');
    }

    function it_should_return_ConvertInteger_when_calling_get_with_int()
    {
        $this::get('int')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertInteger');
    }

    function it_should_return_ConvertStringToUtf8_when_calling_get_with_string_to_utf8()
    {
        $this::get('string_to_utf8')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertStringToUtf8');
    }

    function it_should_return_ConvertWindowsGuid_when_calling_get_with_windows_guid()
    {
        $this::get('windows_guid')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertWindowsGuid');
    }

    function it_should_return_ConvertWindowsSid_when_calling_get_with_windows_sid()
    {
        $this::get('windows_sid')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertWindowsSid');
    }

    function it_should_return_ConvertWindowsTime_when_calling_get_with_windows_time()
    {
        $this::get('windows_time')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertWindowsTime');
    }

    function it_should_return_ConvertWindowsGeneralizedTime_when_calling_get_with_windows_generalized_time()
    {
        $this::get('windows_generalized_time')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertWindowsGeneralizedTime');
    }

    function it_should_return_EncodeWindowsPassword_when_calling_get_with_encode_windows_password()
    {
        $this::get('encode_windows_password')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\EncodeWindowsPassword');
    }

    function it_should_return_ConvertPasswordMustChange_when_calling_get_with_password_must_change()
    {
        $this::get('password_must_change')->shouldReturnAnInstanceOf('\LdapTools\AttributeConverter\ConvertPasswordMustChange');
    }

    function it_should_throw_InvalidArgumentException_when_retrieving_an_invalid_converter_name()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringGet('foo_bar');
    }

    function it_should_throw_InvalidArgumentException_when_the_converter_name_is_already_registered()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringRegister('bool', '\LdapTools\AttributeConverter\ConvertBoolean');
    }

    function it_should_error_when_getting_a_converter_that_does_not_implement_AttributeConverterInterface()
    {
        $this->register('foo_bar', '\LdapTools\Configuration');
        $this->shouldThrow('\Exception')->duringGet('foo_bar');
    }

    function it_should_let_me_set_the_ldap_connection_on_a_returned_converter(LdapConnectionInterface $ldap)
    {
        $this->get('windows_guid')->setLdapConnection($ldap)->shouldBeNull();
    }

    function it_should_let_me_set_the_converter_options_on_a_returned_converter()
    {
        $this->get('windows_guid')->setOptions(['foo' => 'bar'])->shouldBeNull();
    }

    function it_should_let_me_set_the_converter_operation_type_on_a_returned_converter()
    {
        $this->get('windows_guid')->setOperationType(AttributeConverterInterface::TYPE_MODIFY)->shouldBeNull();
    }

    function it_should_let_me_get_the_converter_operation_type_on_a_returned_converter()
    {
        $this->get('windows_guid')->getOperationType()->shouldBeEqualTo(AttributeConverterInterface::TYPE_SEARCH_FROM);
    }

    function it_should_let_me_set_the_dn_on_a_returned_converter()
    {
        $this->get('windows_guid')->setDn('cn=foo,dc=foo,dc=bar')->shouldBeNull();
    }

    function it_should_let_me_get_the_dn_on_a_returned_converter()
    {
        $this->get('windows_guid')->getDn()->shouldBeNull();
    }
}

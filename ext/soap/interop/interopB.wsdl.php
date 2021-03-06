<?php
header("Content-Type: text/xml");
echo '<?xml version="1.0"?>';
echo "\n";
?>
<definitions name="InteropTest"
  targetNamespace="http://soapinterop.org/"
  xmlns="http://schemas.xmlsoap.org/wsdl/"
  xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
  xmlns:tns="http://soapinterop.org/"
  xmlns:s="http://soapinterop.org/xsd"
  xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/">

	<types>
		<schema xmlns="http://www.w3.org/2001/XMLSchema"
		  targetNamespace="http://soapinterop.org/xsd">

			<import namespace="http://schemas.xmlsoap.org/soap/encoding/" />

			<complexType name="ArrayOfstring">
				<complexContent>
					<restriction base="SOAP-ENC:Array">
 						<attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="string[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOfint">
				<complexContent>
					<restriction base="SOAP-ENC:Array">
						<attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="int[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOffloat">
				<complexContent>
					<restriction base="SOAP-ENC:Array">
						<attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="float[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="ArrayOfSOAPStruct">
				<complexContent>
					<restriction base="SOAP-ENC:Array">
						<attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="s:SOAPStruct[]"/>
					</restriction>
				</complexContent>
			</complexType>
			<complexType name="SOAPStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
				</all>
			</complexType>
			<complexType name="SOAPStructStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
					<element name="varStruct" type="s:SOAPStruct"/>
				</all>
			</complexType>
			<complexType name="SOAPArrayStruct">
				<all>
					<element name="varString" type="string" nillable="true"/>
					<element name="varInt" type="int" nillable="true"/>
					<element name="varFloat" type="float" nillable="true"/>
					<element name="varArray" type="s:ArrayOfstring"/>
				</all>
			</complexType>
   		<complexType name="ArrayOfString2D">
     		<complexContent>
					<restriction base="SOAP-ENC:Array">
	     			<attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="string[,]"/>
					</restriction>
     		</complexContent>
   		</complexType>
		</schema>
	</types>

	<message name="echoStructAsSimpleTypesRequest">
		<part name="inputStruct" type="s:SOAPStruct"/>
	</message>
	<message name="echoStructAsSimpleTypesResponse">
		<part name="outputString" type="xsd:string"/>
		<part name="outputInteger" type="xsd:int"/>
		<part name="outputFloat" type="xsd:float"/>
	</message>
	<message name="echoSimpleTypesAsStructRequest">
		<part name="inputString" type="xsd:string"/>
		<part name="inputInteger" type="xsd:int"/>
		<part name="inputFloat" type="xsd:float"/>
	</message>
	<message name="echoSimpleTypesAsStructResponse">
		<part name="return" type="s:SOAPStruct"/>
	</message>
	<message name="echo2DStringArrayRequest">
		<part name="input2DStringArray" type="s:ArrayOfString2D"/>
	</message>
	<message name="echo2DStringArrayResponse">
		<part name="return" type="s:ArrayOfString2D"/>
	</message>
	<message name="echoNestedStructRequest">
		<part name="inputStruct" type="s:SOAPStructStruct"/>
	</message>
	<message name="echoNestedStructResponse">
		<part name="return" type="s:SOAPStructStruct"/>
	</message>
		<message name="echoNestedArrayRequest">
		<part name="inputStruct" type="s:SOAPArrayStruct"/>
	</message>
	<message name="echoNestedArrayResponse">
		<part name="return" type="s:SOAPArrayStruct"/>
	</message>

	<portType name="InteropTestPortTypeB">
		<operation name="echoStructAsSimpleTypes" parameterOrder="inputStruct outputString outputInteger outputFloat">
			<input message="tns:echoStructAsSimpleTypesRequest" name="echoStructAsSimpleTypes"/>
			<output message="tns:echoStructAsSimpleTypesResponse" name="echoStructAsSimpleTypesResponse"/>
		</operation>
		<operation name="echoSimpleTypesAsStruct" parameterOrder="inputString inputInteger inputFloat">
			<input message="tns:echoSimpleTypesAsStructRequest" name="echoSimpleTypesAsStruct"/>
			<output message="tns:echoSimpleTypesAsStructResponse" name="echoSimpleTypesAsStructResponse"/>
		</operation>
		<operation name="echo2DStringArray" parameterOrder="input2DStringArray">
			<input message="tns:echo2DStringArrayRequest" name="echo2DStringArray"/>
			<output message="tns:echo2DStringArrayResponse" name="echo2DStringArrayResponse"/>
		</operation>
		<operation name="echoNestedStruct" parameterOrder="inputStruct">
			<input message="tns:echoNestedStructRequest" name="echoNestedStruct"/>
			<output message="tns:echoNestedStructResponse" name="echoNestedStructResponse"/>
		</operation>
		<operation name="echoNestedArray" parameterOrder="inputStruct">
			<input message="tns:echoNestedArrayRequest" name="echoNestedArray"/>
			<output message="tns:echoNestedArrayResponse" name="echoNestedArrayResponse"/>
		</operation>
	</portType>

	<binding name="InteropTestSoapBindingB" type="tns:InteropTestPortTypeB">
		<soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
		<operation name="echoStructAsSimpleTypes">
			<soap:operation soapAction="http://soapinterop.org/"/>
			<input>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</input>
			<output>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</output>
		</operation>
		<operation name="echoSimpleTypesAsStruct">
			<soap:operation soapAction="http://soapinterop.org/"/>
			<input>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</input>
			<output>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</output>
		</operation>
		<operation name="echo2DStringArray">
			<soap:operation soapAction="http://soapinterop.org/"/>
			<input>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</input>
			<output>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</output>
		</operation>
		<operation name="echoNestedStruct">
			<soap:operation soapAction="http://soapinterop.org/"/>
			<input>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</input>
			<output>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</output>
		</operation>
		<operation name="echoNestedArray">
			<soap:operation soapAction="http://soapinterop.org/"/>
			<input>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</input>
			<output>
				<soap:body use="encoded" namespace="http://soapinterop.org/" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
			</output>
		</operation>
	</binding>

	<service name="interopLabB">
  		<port name="interopTestPortB" binding="tns:InteropTestSoapBindingB">
    			<soap:address location="<?php echo ((isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));?>/server_round2_groupB.php"/>
  		</port>
	</service>

</definitions>
